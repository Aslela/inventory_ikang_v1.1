
<script type="text/javascript">
   
   var url = '<?php echo base_url().'/index.php/kategori/getKategoriData'; ?>';
    
   function kategoriController($scope, $http){
        
        $scope.kategories = [];
          $http.get(url).success(function(data){ 
              $scope.kategories=data;
          });
   }
   
   var app = angular.module('app',[]);
   app.controller('kategori_ctl', function($scope, $http){
        $scope.list_data = [];
        $http.get("<?php echo site_url('kategori/getKategoriData'); ?>").success(function(result){
            $scope.list_data = result;
        })
   })
   
   var app = angular.module('modal',[]);
   app.directive('editModal', function(){
        return{
            restrict : 'E',
            replace : true,
            transclude : false,
            compile : function (element, attrs){
                
                //open modal
            	$edit_nav.on('click', function(event){
            
            		if( $(event.target).is($edit_nav) ) {
            			// on mobile open the submenu
            			$(this).children('ul').toggleClass('is-visible');
            		} else {
            			// on mobile close submenu
            			$edit_nav.children('ul').removeClass('is-visible');
            			//show modal layer
            			$form_edit_modal.addClass('is-visible');	
            			//show the selected form
            			( $(event.target).is('.cd-signup') ) ? signup_selected() : edit_selected();
            		}
            
            	});
                
               	//close modal
            	$('.cd-edit-modal').on('click', function(event){
            		if( $(event.target).is($form_edit_modal) || $(event.target).is('.cd-close-form') ) {
            			$form_edit_modal.removeClass('is-visible');
            		}	
            	});
                
            	function edit_selected(){
            		$form_edit_login.addClass('is-selected');
            		$form_edit_signup.removeClass('is-selected');
            		$tab_edit_login.addClass('selected');
            		$tab_edit_signup.removeClass('selected');
            	}
            }
            
        }
   });
   
</script>

<?php $this->load->view('modal/modal_add_kategori')?>
<?php $this->load->view('modal/modal_edit_kategori')?>


<div class="content-container" >
    <div class="well"> 
        <ul>
            <li>
                <a class="cd-signin main-nav"href="#0"> 
                    <button type="button" class="btn btn-primary btn-xl">
                        <span class="glyphicon glyphicon-plus"></span>&nbsp Add Kategori
                    </button>
                </a>
            </li>
        </ul>   
    </div>
    
    <div id='pesan' style="margin:28px 0px 28px 29px;">
            <?php
	           if($msg!= null){
	               echo "<script type='text/javascript'>alert($msg);</script>";
	           }
            ?>
     </div>
    
    <div ng-app="app" >
    <table  class="table table-bordered table-striped" ng-controller="kategori_ctl">
        <thead>
        <tr>
            <th>No</th>
            <th>Nama Kategori</th>
            <th class="span2">
                <div class="btn btn-mini btn-inverse btn-block disabled">
                    <i class="icon-th icon-white"></i> Options
                </div>
            </th>
        </tr>
        </thead>
        
        <tbody>
            <tr ng-repeat="kategori in list_data">
                <td>{{$index+1}}</td>
                <td>{{kategori.Kategori_Name}}</td>
                <td align='center'>     
                    <a class="main-nav" href="#0">           
                        <button type="button" class="btn btn-primary btn-xs">
                        <span class="glyphicon glyphicon-pencil"></span>&nbsp Edit</button>      
                    </a>                                                                   
				<a class="btn btn-danger btn-xs " href=""onclick="return confirm('Are you sure to delete ?');">
				<i class="glyphicon glyphicon-trash"></i>&nbsp Delete</a>
                </td>
            </tr>
            <edit-modal/>

            <?php 

                        $no=0;
                        foreach ($data as $row) 
                        {
                            $no++;
                            ?>
                            <tr>
                                <td><?=$no?></td>
                                <td><?=$row['Kategori_Name']?></td>
                                <td>
                                <a class="edit-nav" href="#0">           
                        <button type="button" class="btn btn-primary btn-xs">
                        <span class="glyphicon glyphicon-pencil"></span>&nbsp Edit</button>      
                    </a>    
                                </td>
                            </tr>
                            <?php
                        }
                     ?>
            
        </tbody>
    </table>
    </div>
</div>