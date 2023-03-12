<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?=$assetDir?>/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Orion PArking</a>
    <?php 
                
                
                $r=\Yii::$app->authManager->getRolesByUser(\Yii::$app->user->id);
             //   $r=\Yii::$app->user->can('admin'); 
                var_dump($r);
                ?>

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


            $adminItems=\Yii::$app->user->can('admin') ?
            [
                'label' => 'Настройки',
                'icon' => 'cog',
            
                'items' => [
                    
                    ['label' => 'Пользователей', 'url' => ['user/index'], 'icon' => 'file'],
                    ['label' => 'Роли', 'url' => ['role/index'], 'icon' => 'file'],
                    ['label' => 'Разрешение', 'url' => ['role/permission'], 'icon' => 'file'],
                ]
            ]:null;

            $moderatorItems = \Yii::$app->user->can('moderator') ? [
                'label' => 'Арендатор',
                'icon' => 'car',
              
                'itemOptions'=>[
                    'active' => true,
                ],

              'items' =>  [
                    ['label' => 'Добавить новое', 'url' => ['tenant/create'], 'icon' => 'file'],
                    ['label' => 'Список арендаторов', 'url' => ['tenant/index'], 'icon' => 'file'],
                    
                ]
                

                
            ]:null;


            $tenantItems =  \Yii::$app->user->can('tenant') ? [
                'label' => 'Мои сотрудники',
                'icon' => 'user',
                'url' => ['employee/self']
            ]:null;

            
           
            [
                'label' => 'История посещений',
                'icon' => 'book',
                'url' => ['history/index']
            ];

            $items = [];


            if($tenantItems){
                $items[] = $tenantItems; 
            }

            if($moderatorItems){
                $items[] = $moderatorItems; 
            }

            if($adminItems){
                $items[] = $adminItems; 
            }

            echo \hail812\adminlte\widgets\Menu::widget([
                'items' => $items,
            ]);
            ?>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>