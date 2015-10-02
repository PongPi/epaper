<?php
//call csss va js

function import_js_css()
{
    //echo plugin_dir_url( __FILE__ ) . '/bootstrap.min.js';
    wp_enqueue_script('my_custom_script', plugin_dir_url( __FILE__ ) . '/bootstrap.min.js' );

    wp_register_style( 'custom_wp_admin_css',  plugin_dir_url( __FILE__ ) . '/bootstrap.min.css', false, '1.0.0' );
    wp_enqueue_style( 'custom_wp_admin_css' );
}
add_action('wp_enqueue_scripts', 'import_js_css');
add_action('admin_print_scripts', 'import_js_css');
add_action('admin_enqueue_scripts', 'import_js_css');


if(!class_exists('WP_List_Table')){
    require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}
class TT_Example_List_Table extends WP_List_Table {
    
    function get_data_user_detail_backend(){
        global $wpdb;
        $table_name = $wpdb->prefix.'user_detail';
        $results = $wpdb->get_results("SELECT * FROM ".$table_name, ARRAY_A);
        return $results;
    }

    function __construct(){
        global $status, $page;
                
        //Set parent defaults
        parent::__construct( array(
            'singular'  => 'user_id',     //singular name of the listed records
            'plural'    => 'user_ids',    //plural name of the listed records
            'ajax'      => false        //does this table support ajax?
        ) );
        
    }

    function column_default($item, $column_name){
        switch($column_name){
            case 'id_user':
            case 'name':
            case 'myMoney':
            case 'myEmail':
                return $item[$column_name];
            default:
                return print_r($item,true); //Show the whole array for troubleshooting purposes
        }
    }

    function column_id_user($item){
        
        
        //Build row actions
        $actions = array(
            'edit'      => sprintf('<a href="?page=%s&action=%s&id_user=%s">Edit</a>',$_REQUEST['page'],'edit',$item['id_user']),
            'delete'    => sprintf('<a href="?page=%s&action=%s&id_user=%s">Delete</a>',$_REQUEST['page'],'delete',$item['id_user']),
        );
        
        //Return the title contents
        return sprintf('%1$s <span style="color:silver">(id:%2$s)</span>%3$s',
            /*$1%s*/ $item['name'],
            /*$2%s*/ $item['id_user'],
            /*$3%s*/ $this->row_actions($actions)
        );


    }

    function column_cb($item){
        return sprintf(
            '<input type="checkbox" name="%1$s[]" value="%2$s" />',
            /*$1%s*/ $this->_args['singular'],  //Let's simply repurpose the table's singular label ("userID")
            /*$2%s*/ $item['id_user']                //The value of the checkbox should be the record's id
        );
    }


    function get_columns(){
        $columns = array(
           'cb'        => '<input type="checkbox" />', //Render a checkbox instead of text
            'id_user'  => 'Tên',
            'myMoney'  => 'Tiền',
            'myEmail'  => 'Email'
        );
        return $columns;
    }

    function get_sortable_columns() {
        $sortable_columns = array(
            'id_user'     => array('id_user',true),     //true means it's already sorted
            'myMoney'     => array('myMoney',false),
            'myEmail'     => array('myEmail',false)
        );
        return $sortable_columns;
    }

    function get_bulk_actions() {
        $actions = array(
            'delete'    => 'Delete'
        );
        return $actions;
    }


    function process_bulk_action() {
        
        global $wpdb;
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

        $table_name = $wpdb->prefix .'user_detail'; // do not forget about tables prefix

        //Detect when a bulk action is being triggered...
        if( 'delete'===$this->current_action() ) {
            $user_id = $_GET['id_user'];
            $result = $wpdb->delete($table_name, array('id_user' => $user_id ), array( '%d' ));
        } else if( 'edit'===$this->current_action() ) {
            $user_id = $_GET['id_user'];
            $this->get_detail_user_backend($user_id);
        }
        
    }
    function update_detail_user_backend($id_user)
    {
        global $wpdb;
        if(isset($_POST['wc-submit']))
        {
            $name = $_POST['wc-name'];
            $email = $_POST['wc-email'];
            
            $table_detail_user = $wpdb->prefix.'user_detail';

            $result = $wpdb->update( 
                $table_detail_user, 
                array( 
                    'name' => $name,
                    'myEmail' => $email
                ), 
                array( 'id_user' => $id_user), 
                array( 
                    '%s',
                    '%s' 
                )
            );

            if($result)
            {
               echo '<br><div class="alert alert-success" role="alert">
      <strong>Update!</strong> Thanh cong.
    </div>';     
            }
            else
            {
                echo 'Insert bi loi !!!!';
            }
        } else if(isset($_POST['wc-addday'])){
            
            $this->update_add_time($id_user);

        } else if(isset($_POST['wc-reset'])){

            
            $NewDate = date('Y-m-d H:i:s');
                
            $table_detail_user = $wpdb->prefix.'user_detail';

            $result = $wpdb->update( 
                $table_detail_user, 
                array( 
                    'endDownload' => $NewDate
                ), 
                array( 'id_user' => $id_user), 
                array( 
                    '%s' 
                )
            );

            if($result)
            {
               echo '<br><div class="alert alert-success" role="alert">
      <strong>Reset thoi gian!</strong> Thanh cong.'.$day.'
    </div>';     
            }
            else
            {
                echo 'Insert bi loi !!!!';
            }
        }
    
    }
    function update_add_time($id_user){

        global $wpdb;
        $detailUser = wc_get_infor_user_detail_by_id($id_user)[0];

        $dateadd = 30;
        $day_vip = get_option('epaper_option_day_vip');
        if(isset($day_vip)){
            $dateadd = intval($day_vip);
        }
        if( strtotime($detailUser->endDownload) < strtotime(date('Y-m-d H:i:s'))) 
        { 
            $day = date('Y-m-d H:i:s');
            $NewDate = date('Y-m-d', strtotime($day . " +".$dateadd." days"));
        } else 
        {
            $day = $detailUser->endDownload;
            $NewDate = date('Y-m-d', strtotime($day . " +".$dateadd." days"));
        }

        $table_detail_user = $wpdb->prefix.'user_detail';

        $result = $wpdb->update( 
            $table_detail_user, 
            array( 
                'endDownload' => $NewDate
            ), 
            array( 'id_user' => $id_user), 
            array( 
                '%s' 
            )
        );

        if($result)
        {
           echo '<br><div class="alert alert-success" role="alert">
              <strong>Gia han!</strong> Thanh cong.'.$day.'
            </div>';     
        }
        else
        {
            echo 'Insert bi loi !!!!';
        }

    }
    function get_detail_user_backend($id_user)
    {
            // Logged in.
            global $wpdb;
            
            $this->update_detail_user_backend($id_user);

            $table_name_download = $wpdb->prefix.'user_download';
            $results = $wpdb->get_results("SELECT * FROM ".$table_name_download." where id_user = ".$id_user);

            $currentUser = wc_get_infor_user_detail($id_user);
            $currentUser = $currentUser[0];

            

            if($currentUser){
                
                ?>
            <div class="clearfix"></div>
            <div class="container wrap">
                <div class="row">
                    <div class="col-md-8">
                <form action="<?php echo esc_url( $_SERVER['REQUEST_URI'] ); ?>" method="post" style="padding: 25px;background-color: #ECECEC;">
                  <div class="form-group">
                    <label for="name">Tên khách hàng</label>
                    <input type="text" value="<?php echo $currentUser->name ?>" class="form-control" id="name" placeholder="Text" name="wc-name">
                  </div>
                  <div class="form-group">
                    <label for="Email">Email</label>
                    <input type="Email" value="<?php echo $currentUser->myEmail; ?>" class="form-control" id="exampleInputPassword1" placeholder="Email" name="wc-email">
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-6 control-label">Thời gian hết hạn</label>
                    <div class="col-sm-6">
                      <p class="form-control-static"><?php 
                            if( strtotime($currentUser->endDownload) <= strtotime(date('Y-m-d H:i:s'))) 
                            { 
                              echo "Hết hạn"; 
                            } else 
                            { 
                              echo $currentUser->endDownload; 
                            } 
                      ?></p>
                    </div>
                  </div>
                  <br>
                  <div class="form-group">
                  <div class="col-sm-6"><button type="submit" class="btn btn-danger" name="wc-addday">Cộng thêm 30 ngày sử dụng</button>
                  </div>
                  <div class="col-sm-3">
                        
                        <button type="submit" class="btn btn-success" name="wc-reset">Reset thời gian</button>
                    </div>
                  <div class="col-sm-3">
                        
                        <button type="submit" class="btn btn-success" name="wc-submit">Lưu thông tin</button>
                    </div>
                  </div>
                  <br>
                </form>

              
                    </div>
                </div>
            </div>
                <div class="container wrap">
                <div class="row">
                    <div class="col-md-11">
                <div class="table-responsive">
                      <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Tên sách</th>
                            <th>Ngày dowload</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                            $i = 1;
                            foreach ($results as $result)
                            {
                                ?>
                                <tr>
                                  <th scope="row"><?php echo $i; ?></th>
                                  <td><?php echo $result->name_product; ?></td>
                                  <td><?php echo $result->downloadDate; ?></td>
                                </tr>

                                <?php 
                                $i ++;
                                }
                            ?>
                        </tbody>
                      </table>
                    </div>
                </div>
                </div>
            </div>
            <div class="clearfix"></div>
                     <?php
            } else {
                echo "Không tìm thấy khách hàng.";
            }
    }

    function prepare_items() {
        global $wpdb;
        $per_page = 5;

        $columns = $this->get_columns();
        $hidden = array();
        $sortable = $this->get_sortable_columns();
        
        $this->_column_headers = array($columns, $hidden, $sortable);    
        $this->process_bulk_action();
        $data = $this->get_data_user_detail_backend();        

        function usort_reorder($a,$b){
            $orderby = (!empty($_REQUEST['orderby'])) ? $_REQUEST['orderby'] : 'id_user'; //If no sort, default to title
            $order = (!empty($_REQUEST['order'])) ? $_REQUEST['order'] : 'asc'; //If no order, default to asc
            $result = strcmp($a[$orderby], $b[$orderby]); //Determine sort order
            return ($order==='asc') ? $result : -$result; //Send final sort direction to usort
        }
        usort($data, 'usort_reorder');
        
        $current_page = $this->get_pagenum();
        
        $total_items = count($data);
        
        
        $data = array_slice($data,(($current_page-1)*$per_page),$per_page);
        
        
        $this->items = $data;
        
        $this->set_pagination_args( array(
            'total_items' => $total_items,                  //WE have to calculate the total number of items
            'per_page'    => $per_page,                     //WE have to determine how many items to show on a page
            'total_pages' => ceil($total_items/$per_page)   //WE have to calculate the total number of pages
        ) );
    }


}

function tt_render_list_page(){
    
    $testListTable = new TT_Example_List_Table();
    //Fetch, prepare, sort, and filter our data...
    $testListTable->prepare_items();
    
    ?>
    <div class="container wrap">
        <div class="row">
            <div class="col-md-12">
        <div class="wrap">
            
            <div id="icon-users" class="icon32"><br/></div>
            <!-- Forms are NOT created automatically, so you need to wrap the table in one to use features like bulk actions -->
            <form id="userIDs-filter" method="get">
                <!-- For plugins, we also need to ensure that the form posts back to our current page -->
                <input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>" />
                <!-- Now we can render the completed list table -->
                <?php $testListTable->display() ?>
            </form>
            
        </div>
            </div>
        </div>
    </div>
    <?php
}