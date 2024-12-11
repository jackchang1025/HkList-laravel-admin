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
            'is_active' => 'nullable|boolean',
            'sort_field' => 'nullable|string|in:id,cid,created_at,updated_at',
            'sort_order' => 'nullable|string|in:asc,desc'
        ]);

        $query = EnterpriseAccount::query();

        // 关键词搜索
        if (!empty($validated['keyword'])) {
            $keyword = $validated['keyword'];
            $query->where(function($q) use ($keyword) {
                $q->where('cid', 'like', "%{$keyword}%")
                  ->orWhere('surl', 'like', "%{$keyword}%")
                  ->orWhere('path', 'like', "%{$keyword}%");
            });
        }

        // 激活状态筛选
        if (isset($validated['is_active'])) {
            $query->where('is_active', $validated['is_active']);
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