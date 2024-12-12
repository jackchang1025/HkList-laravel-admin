<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EnterpriseAccountRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'name' => 'nullable|string|max:191',
            'cookie' => 'required|string',
            'cid' => 'required|string|max:191',
            'bdstoken' => 'required|string|max:191',
            'surl' => 'required|string|max:191',
            'pwd' => 'nullable|string|max:32',
            'path' => 'required|string|max:191',
            'is_active' => 'boolean'
        ];

        // 更新时cid的唯一性验证需要排除当前记录
        if ($this->isMethod('PATCH')) {
            $rules['cid'] = 'required|string|max:191|unique:enterprise_accounts,cid,' . $this->route('id');
        } else {
            $rules['cid'] = 'required|string|max:191|unique:enterprise_accounts';
        }

        return $rules;
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'name.string' => '企业账号名称必须是字符串',
            'name.max' => '企业账号名称不能超过191个字符',
            
            'cookie.required' => 'Cookie凭证不能为空',
            'cookie.string' => 'Cookie凭证必须是字符串',
            
            'cid.required' => '企业账号ID不能为空',
            'cid.string' => '企业账号ID必须是字符串',
            'cid.max' => '企业账号ID不能超过191个字符',
            'cid.unique' => '该企业账号ID已存在',
            
            'bdstoken.required' => '安全令牌不能为空',
            'bdstoken.string' => '安全令牌必须是字符串',
            'bdstoken.max' => '安全令牌不能超过191个字符',
            
            'surl.required' => '分享短链接不能为空',
            'surl.string' => '分享短链接必须是字符串',
            'surl.max' => '分享短链接不能超过191个字符',
            
            'pwd.string' => '提取密码必须是字符串',
            'pwd.max' => '提取密码不能超过32个字符',
            
            'path.required' => '存储路径不能为空',
            'path.string' => '存储路径必须是字符串',
            'path.max' => '存储路径不能超过191个字符',
            
            'is_active.boolean' => '激活状态必须是布尔值'
        ];
    }
} 