<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="<?=$assetDir?>/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Orion Parking </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?=$assetDir?>/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Administrator</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <!-- href be escaped -->
        <!-- <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div> -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <?php
            echo \hail812\adminlte\widgets\Menu::widget([
                'items' => [
                    [
                        'label' => 'Сотрудники',
                        'icon' => 'user',
                        'url' => ['employee/self']
                    ],
                    [
                        'label' => 'Арендатор',
                        'icon' => 'car',
                      
                        'itemOptions'=>[
                            'active' => true,
                        ],

                      //  'items' => \Yii::$app->user->can('createTenant') ?
                      'items' =>  [
                            ['label' => 'Добавить новое', 'url' => ['tenant/create'], 'icon' => 'file'],
                            ['label' => 'Список арендаторов', 'url' => ['tenant/index'], 'icon' => 'file'],
                            
                        ]
                        //:[],
                        

                        
                    ],
                   
                    [
                        'label' => 'История посещений',
                        'icon' => 'book',
                        'url' => ['history/index']
                    ],
                    [
                        'label' => 'Настройки',
                        'icon' => 'cog',
                       
                        'items' => [
                            
                            ['label' => 'Пользователей', 'url' => ['user/index'], 'icon' => 'file'],
                            ['label' => 'Роли', 'url' => ['role/index'], 'icon' => 'file'],
                            ['label' => 'Разрешение', 'url' => ['role/permission'], 'icon' => 'file'],
                        ]
                    ],
                    
                ],
            ]);
            ?>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>