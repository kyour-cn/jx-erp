<?php

namespace app\admin\validate;

use think\Validate;

class Admin extends Validate
{
    protected $rule = [
        'username' => 'require|regex:^[a-zA-Z][a-zA-Z0-9_]{2,15}$|unique:admin',
        'nickname' => 'require',
        'password' => 'require|regex:^[a-zA-Z0-9_]{6,32}$',
        'email'    => 'email|unique:admin',
        'mobile'   => 'mobile|unique:admin',
    ];

    /**
     * 验证提示信息
     * @var array
     */
    protected $message = [];

    /**
     * 字段描述
     */
    protected $field = [
    ];

    /**
     * 验证场景
     */
    protected $scene = [
        'add'  => ['username', 'nickname', 'password', 'email', 'mobile'],
        'edit' => ['username', 'nickname', 'password', 'email', 'mobile'],
    ];

    /**
     * 验证场景-前台自己修改自己资料
     */
    public function sceneInfo()
    {
        return $this->only(['nickname', 'password', 'email', 'mobile'])
            ->remove('password', 'require');
    }

    public function __construct()
    {
        $this->field   = [
            'username' => __('Username'),
            'nickname' => __('Nickname'),
            'password' => __('Password'),
            'email'    => __('Email'),
            'mobile'   => __('Mobile')
        ];
        $this->message = array_merge($this->message, [
            'username.regex' => __('Please input correct username'),
            'password.regex' => __('Please input correct password')
        ]);
        parent::__construct();
    }
}