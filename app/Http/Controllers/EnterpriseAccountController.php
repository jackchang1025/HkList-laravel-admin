<?php

namespace App\Http\Controllers;

use App\Models\EnterpriseAccount;
use Illuminate\Http\Request;
use App\Http\Controllers\ResponseController;
use App\Http\Requests\EnterpriseAccountRequest;

class EnterpriseAccountController extends Controller
{
    /**
     * 获取企业账号列表
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {

        $validated = $request->validate([
            'page' => 'integer|min:1',
            'size' => 'integer|min:1|max:100',
            'keyword' => 'nullable|string|max:50',
            'is_active' => 'nullable',
            'sort_field' => 'nullable|string|in:id,name,cid,created_at,updated_at',
            'sort_order' => 'nullable|string|in:asc,desc'
        ], [
            'page.integer' => '页码必须是整数',
            'page.min' => '页码最小值为1',
            'size.integer' => '每页显示数量必须是整数',
            'size.min' => '每页显示数量最小值为1',
            'size.max' => '每页显示数量最大值为100',
            'keyword.string' => '关键词必须是字符串',
            'keyword.max' => '关键词最大长度为50个字符',
            'sort_field.string' => '排序字段必须是字符串',
            'sort_field.in' => '排序字段必须是id, name, cid, created_at, updated_at之一',
            'sort_order.string' => '排序顺序必须是字符串',
            'sort_order.in' => '排序顺序必须是asc或desc'
        ]);

        $query = EnterpriseAccount::query();

        // 关键词搜索
        if (!empty($validated['keyword'])) {
            $keyword = trim(preg_replace('/\s+/', '', $validated['keyword']));
            if (!empty($keyword)) {
                $query->where(function($q) use ($keyword) {
                    $q->where('name', 'like', "%{$keyword}%")
                      ->orWhere('cid', 'like', "%{$keyword}%")
                      ->orWhere('surl', 'like', "%{$keyword}%")
                      ->orWhere('path', 'like', "%{$keyword}%");
                });
            }
        }

        // 激活状态筛选
        if (isset($validated['is_active'])) {

            if ($validated['is_active'] === 'true') {
                $query->where('is_active', true);
            } else {
                $query->where('is_active', false);
            }
        }

        // 排序
        $sortField = $validated['sort_field'] ?? 'id';
        $sortOrder = $validated['sort_order'] ?? 'desc';
        $query->orderBy($sortField, $sortOrder);

        // 分页
        $perPage = $validated['size'] ?? 15;
        $accounts = $query->paginate($perPage);

        return ResponseController::success([
            'list' => $accounts->items(),
            'pagination' => [
                'total' => $accounts->total(),
                'current_page' => $accounts->currentPage(),
                'size' => $accounts->perPage(),
                'last_page' => $accounts->lastPage()
            ]
        ]);
    }

    /**
     * 创建新的企业账号
     * 
     * @param EnterpriseAccountRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(EnterpriseAccountRequest $request)
    {
        $validated = $request->validated();
        
        // 如果没有提供name，使用cid作为默认名称
        if (empty($validated['name'])) {
            $validated['name'] = $validated['cid'];
        }
        
        $account = EnterpriseAccount::create($validated);
        
        return ResponseController::success([
            'account' => $account
        ], '创建成功');
    }

    /**
     * 更新企业账号信息
     * 
     * @param EnterpriseAccountRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(EnterpriseAccountRequest $request, $id)
    {
        $validated = $request->validated();
        
        // 如果没有提供name，使用cid作为默认名称
        if (empty($validated['name'])) {
            $validated['name'] = $validated['cid'];
        }
        
        $account = EnterpriseAccount::findOrFail($id);
        $account->update($validated);
        
        return ResponseController::success([
            'account' => $account
        ], '更新成功');
    }

    /**
     * 删除企业账号
     */
    public function destroy($id)
    {
        $account = EnterpriseAccount::findOrFail($id);
        
        // 检查是否有关联的账号
        if ($account->accounts()->count() > 0) {
            return ResponseController::error(message:'该企业账号下存在关联的百度账号,无法删除',statusCode:400);
        }
        
        $account->delete();
        return ResponseController::success(null, '删除成功');
    }

    /**
     * 批量删除企业账号
     */
    public function batchDestroy(Request $request)
    {
        $validated = $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'integer'
        ]);

        // 检查所有要删除的账号是否有关联
        $hasAccounts = EnterpriseAccount::whereIn('id', $validated['ids'])
            ->whereHas('accounts')
            ->exists();
        
        if ($hasAccounts) {
            return ResponseController::error('选中的企业账号中存在关联的百度账号,无法删除',statusCode:400);
        }

        EnterpriseAccount::whereIn('id', $validated['ids'])->delete();
        return ResponseController::success(null, '批量删除成功');
    }

    /**
     * 切换账号激活状态
     */
    public function toggleActive($id)
    {
        $account = EnterpriseAccount::findOrFail($id);
        $account->is_active = !$account->is_active;
        $account->save();
        
        return ResponseController::success([
            'account' => $account,
            'status' => $account->is_active ? '已激活' : '已停用'
        ]);
    }
} 