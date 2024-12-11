<?php

namespace App\Services;

use App\Models\EnterpriseAccount;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\ParseController;
class DownloadTicketService
{
    private const QUEUE_KEY = 'download_tickets:queue';
    private const LOCK_KEY = 'download_tickets:lock';
    
    public static function getNextTicket(): ?array
    {
        try {
            // 使用原子操作获取并更新队列
            return Cache::lock(self::LOCK_KEY, 10)->block(5, function () {
                // 获取当前队列
                $tickets = Cache::get(self::QUEUE_KEY);
                
                // 如果队列为空，尝试重新填充
                if (empty($tickets)) {
                    //判断 EnterpriseAccount 的下载票据是否为空
                    if (EnterpriseAccount::where('is_active', true)->count() === 0) {
                        throw new \Exception('No active EnterpriseAccount found');
                    }

                    self::refillQueue();
                    $tickets = Cache::get(self::QUEUE_KEY);
                }

                if (empty($tickets)) {
                    return null;
                }

                // 取出第一个票据
                $ticket = array_shift($tickets);
                
                // 更新队列（原子操作）
                Cache::put(self::QUEUE_KEY, $tickets);

                //将获取到的 EnterpriseAccount 写入日志
                Log::info('Get next download ticket: ', ['ticket' => $ticket]);

                return $ticket;
            });
            
        } catch (\Exception $e) {
            Log::error('Error getting next download ticket: ' . $e->getMessage());
            return null;
        }
    }
    
    private static function refillQueue(): void
    {
        try {
            // 获取所有激活的账号的 download_ticket
            $tickets = EnterpriseAccount::query()
                ->where('is_active', true)
                ->orderBy('id')
                ->get()
                ->makeHidden(['is_active', 'created_at', 'updated_at','deleted_at'])
                ->toArray();
            
            if (!empty($tickets)) {
                // 将所有票据放入队列（在锁内执行）
                Cache::put(self::QUEUE_KEY, $tickets);

                //记录日志
                Log::info('Refill download ticket queue: ', ['tickets' => $tickets]);
            }
        } catch (\Exception $e) {
            Log::error('Error refilling queue: ' . $e->getMessage());
            throw $e;
        }
    }
        
    /**
     * 手动重置队列
     * 可以在添加/删除/修改企业账号时调用
     */
    public static function resetQueue(): void
    {
        try {
            Cache::lock(self::LOCK_KEY, 10)->block(5, function () {
                Cache::forget(self::QUEUE_KEY);
                self::refillQueue();
            });
        } catch (\Exception $e) {
            Log::error('Error resetting queue: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * 获取当前队列长度
     */
    public static function getQueueLength(): int
    {
        return count(Cache::get(self::QUEUE_KEY, []));
    }

    /**
     * 检查队列是否需要重新填充
     */
    public static function needsRefill(): bool
    {
        return self::getQueueLength() === 0;
    }
}