<?php
include_once 'models/user.php';
if(!$user->super_is_loggedin())
{
    $user->redirect('?go=login');
}
$user_id = $_SESSION['super_session'];
$stmt = $DB_con->prepare("SELECT * FROM superadmin WHERE id=:id");
$stmt->execute(array(":id"=>$user_id));
$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Dashboard - ADMIN WEB</title>

    <!-- Bootstrap Core CSS -->
    <link href="bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="dist/css/timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="bower_components/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
               <a class="navbar-brand" href="">Dashboard - ADMIN WEB</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-user fa-fw"></i> <?php print($userRow['username']); ?> <i class="fa fa-caret-down"></i></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        
                        <li><a href="?go=logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        
                        <li>
                            <a href="?go=dashboardsuperadmin"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        
                        <li>
                            <a href="?go=dashboardsuperpendaftar"><i class="fa fa-table fa-fw"></i> Pendaftar</a>
                        </li>
                        <li>
                            <a href="?go=dashboardsuperukm"><i class="fa fa-edit fa-fw"></i> UKM</a>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">

            <div class="row">

                <div class="col-lg-12">
                    <h1 class="page-header">UKM Tools</h1>
                </div>

                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
              <div class="panel panel-default">
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Create UKM
                        </div>
                        <div class="panel-body col-md-6">

                            <form class="well" action="/mvc-ukm/?go=createukm" method="post">
                     <h3 >TAMBAH UKM</h3>
                     
                        <label>Pilih UKM</label>
                         <select class="form-control" name="ukmname"  >
                                                                                                   <!--akan menggunakan php-->
                                 <?php 
                                $dbh = Database::getInstance();
                                $rs = $dbh->query("SELECT * FROM ukmdefault where status_terdaftar='0'");    //where status='0'
                                    foreach ($rs as $pendaftar => $list)
                                    {
                                        echo '
                                    
                                       <option>'.$list['namaukm'].'</td></option>
                                        
                                        ';
                                    }

                                ?>    
                        </select>
                                              
                    
                                           

                                    <button type="submit" class="btn btn-default">Daftar</button>
                                                
                            </form>
                            

                <form class="well" action="/mvc-ukm/?go=createadmin" method="post">
                     <h3 >TAMBAH ADMIN UKM</h3>
                     
                        <label>Pilih UKM (daftarkan jika belum ada)</label>
                                                                                                <!--akan menggunakan php-->
                        <select class="form-control" name="ukmname"  >


                        <?php 
                        $dbh = Database::getInstance();
                        $rs = $dbh->query("SELECT * FROM ukmlist");    //where status='0'
//
                            foreach ($rs as $pendaftar => $list)
                            {
                                echo '
                            
                               <option>'.$list['namaukm'].'</td></option>
                                
                                ';
                            }

                        ?>
                  
                         </select>
                                              
                                              
                                             
                                            <br>
                                            <div class="form-group">
                                              <label >Username:</label>
                                              <input type="text" class="form-control" placeholder="Username Admin" name="username" required>
                                            </div>
                                            <div class="form-group">
                                              <label >Password:</label>
                                              <input type="password" class="form-control" placeholder="Password" name="password" required>
                                            </div>
                                           

                                    <button type="submit" class="btn btn-default">Daftar</button>
                                                
                            </form>


                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->

                    </div>
                    <!-- /.panel -->

                </div>

                <!-- /.col-lg-12 -->
            </div>
</div>





            <div class="panel panel-default">
                        <div class="panel-heading">
                            UKM TERDAFTAR
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-semua">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>NAMA UKM</th>
                                            <th>KUOTA</th>
                                            <th>AKSI</th>
                                          
                                        </tr>
                                    </thead>
                                    <tbody>
                                         <?php 
                                            $dbh = Database::getInstance();
                                            $rs = $dbh->query("SELECT * FROM ukmlist ");   
                                            foreach ($rs as $ukmlist => $list)
                                            {
                                                echo '<tr class="even gradeC">
                                                <td>'.$list['id'].'</td>
                                                <td>'.$list['namaukm'].'</td>
                                                <td>'.$list['kuota'].'</td>
                                               
                                               
                                                <td><a href="?go=hapusukm&i='.$list['namaukm'].' ">Hapus</a> </td>      
                                                </tr>';
                                            }

                                        ?>               
                                 </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                            
                        </div>
                        <!-- /.panel-body -->



                    </div>


                    <div class="panel panel-default">
                        <div class="panel-heading">
                            ADMIN UKM TERDAFTAR
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-terima">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>NAMA UKM</th>
                                            <th>USERNAME</th>
                                            <th>AKSI</th>
                                          
                                        </tr>
                                    </thead>
                                    <tbody>
                                         <?php 
                                            $dbh = Database::getInstance();
                                            $rs = $dbh->query("SELECT * FROM adminukm ");   
                                            foreach ($rs as $adminukm => $list)
                                            {
                                                echo '<tr class="even gradeC">
                                                <td>'.$list['id'].'</td>
                                                <td>'.$list['ukmname'].'</td>
                                                <td>'.$list['username'].'</td>
                                               
                                               
                                                <td><a href="?go=hapusadminukm&i='.$list['username'].' ">Hapus</a> </td>      
                                                </tr>';
                                            }

                                        ?>               
                                 </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                            
                        </div>
                        <!-- /.panel-body -->



                    </div>


                    
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
     <script src="bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="dist/js/sb-admin-2.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
  <script>
    $(document).ready(function() {
        $('#dataTables-semua').DataTable({
                responsive: true
        });
    });
    $(document).ready(function() {
        $('#dataTables-terima').DataTable({
                responsive: true
        });
    });
    $(document).ready(function() {
        $('#dataTables-tolak').DataTable({
                responsive: true
        });
    });
    </script>
</body>

</html>
