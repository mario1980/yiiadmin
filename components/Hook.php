<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\components;

use Yii;

/**
 * Description of Hook
 *
 * @author Sylar
 */
class Hook extends \yii\base\Component{
    
    public static function load($name, $params=NULL)
    {
        $hook = new Hook();
        return $hook->_load($name, $params);
    }

    private function _load($name, $params)
    {
        $hook =\app\models\SysHooks::findOne(['name' => $name]);
        
        if ( ! $hook) return FALSE;
        
        $modules = array();
        
        //加载公共模块
        $list = $hook->modules != '' ? explode(',', $hook->modules) : array();
        if ($list)
        {
            $models = \app\models\SysModules::findAll(['id' => $list]);
            foreach ($models as $model)
            {   
                ! $model->name ? '' : $modules[$model->id]['name']  = $model->name;
                $modules[$model->id]['class'] = $model->class;

                if ($model->config)
                {
                    $config = json_decode($model->config, TRUE);
                    $modules[$model->id] += $config;
                }
            }
        }
        
        //加载自定义模块
        foreach ($hook->getSysHookModules()->all() as $model)
        {
            $module = $model->getModule();
            if ($module->status == 0) continue;
                  
            ! $module->name ? '' : $modules[$module->id]['name']  = $module->name;
            $modules[$module->id]['class'] = $module->class;
            
            if ($model->config)
            {
                $config = json_decode($model->config, TRUE);
                $modules[$module->id] += $config;
            }
            elseif ($module->config)
            {
                $config = json_decode($module->config, TRUE);
                $modules[$module->id] += $config;                
            }
        }
        
        switch ($hook->type)
        {
            case 'module':
                $modules = $this->_module($modules, $params);
                break;
            
            case 'event':
                $this->_event($modules, $params);
                break;
            
            case 'widget':
                $this->_widget($modules, $params);
                break;
        }
        
        return $modules;
    }

    private function _module($data, $module)
    {
        $modules = array();
        foreach ($data as $v)
        {
            $modules[$v['name']] = $v;
            unset($modules[$v['name']]['name']);
        }
        $module->modules = $modules;
        return $modules;
    }


    private function _event($events, $params)
    {
        foreach ($events as $v)
        {
            if ($params)
            {
                $v = array_merge($v, $params);
            }
            $event = Yii::createObject($v);
            $event->handle();
        }
    }
    

    private function _widget($widgets, $params)
    {
        foreach ($widgets as $v)
        {
            $widget = $v['class'];
            unset($v['class']);
            if ($params)
            {
                $params = array_merge($v, $params);
            }
            echo $widget::widget($v);
        }
    }
}
