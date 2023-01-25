<?php

namespace App\Main\Parent;

class ParentSideMenu
{
    /**
     * List of side menu items.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public static function menu()
    {
        return [
            'dashboard' => [
                'icon' => 'home',
                'route_name' => 'parentdashboard',
                'params' => [
                    'layout' => 'side-menu',
                ],
                'title' => 'Dashboard',
            ],
            'classroutine' => [
                'icon' => 'trello',
                'route_name' => 'parentclassrountine',
                'params' => [
                    'layout' => 'side-menu',
                ],
                'title' => 'Class Routine',
            ],
            'fees' => [
                'icon' => 'dollar-sign',
                'route_name' => 'parentfee',
                'params' => [
                    'layout' => 'side-menu',
                ],
                'title' => 'Fees',
            ],
            'homework' => [
                'icon' => 'book-open',
                'route_name' => 'parenthomework',
                'params' => [
                    'layout' => 'side-menu',
                ],
                'title' => 'Home Work',
            ],
            'attendance' => [
                'icon' => 'user-check',
                'route_name' => 'parentattendance',
                'params' => [
                    'layout' => 'side-menu',
                ],
                'title' => 'Attendance',
            ],
            'examination' => [
                'icon' => 'hexagon',
                'route_name' => 'parentexam',
                'params' => [
                    'layout' => 'side-menu',
                ],
                'title' => 'Examination',
            ],
            // 'communication' => [
            //     'icon' => 'message-circle',
            //     'route_name' => 'parentcommunication',
            //     'params' => [
            //         'layout' => 'side-menu',
            //     ],
            //     'title' => 'Communication',
            // ],
            // 'virtualclass' => [
            //     'icon' => 'airplay',
            //     'route_name' => 'parentvirtualclasstoday',
            //     'params' => [
            //         'layout' => 'side-menu',
            //     ],
            //     'title' => 'Virtual Class',
            // ],
            'materials' => [
                'icon' => 'package',
                'route_name' => 'parentmaterial',
                'params' => [
                    'layout' => 'side-menu',
                ],
                'title' => 'Materials',
            ],
            'feed' => [
                'icon' => 'align-center',
                'route_name' => 'aparentfeedlatest',
                'params' => [
                    'layout' => 'side-menu',
                ],
                'title' => 'School Talkz',
            ],
            'setting' => [
                'icon' => 'settings',
                'params' => [
                    'layout' => 'side-menu',
                ],
                'title' => 'Settings',
            ],
        ];
    }
}
