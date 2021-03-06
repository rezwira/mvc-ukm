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
                    <h1 class="page-header">Tables</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
            <div class="col-md-12">
                 <div class="panel panel-default">
                        <div class="panel-heading">
                            Data Semua Pendaftar
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-semua">
                                    <thead>
                                        <tr>
                                            <th>ID DAFTAR</th>
                                            <th>UKM</th>
                                            <th>NIM</th>
                                            <th>NAMA</th>
                                            <th>GENDER</th>
                                            <th>NO HP</th>
                                            <th>AKSI</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                         <?php 
                            $dbh = Database::getInstance();
                            $rs = $dbh->query("SELECT * FROM pendaftar WHERE terima='0' and tolak='0'  ");    //where status='0'
    //                         
                            foreach ($rs as $pendaftar => $list)
                            {
                                echo '<tr class="even gradeC">
                                <td>'.$list['idpendaftar'].'</td>
                                <td>'.$list['nama_ukm'].'</td>
                                <td>'.$list['nim'].'</td>
                                <td>'.$list['nama'].'</td>
                                <td>'.$list['gender'].'</td>
                                <td>'.$list['phone'].'</td>
                                <td><a href="?go=dashboardukmapendaftar-batal&i='.$list['idpendaftar'].' ">Edit</a> </td>      
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
                            DITERIMA
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-semua">
                                    <thead>
                                        <tr>
                                            <th>ID DAFTAR</th>
                                            <th>UKM</th>
                                            <th>NIM</th>
                                            <th>NAMA</th>
                                            <th>GENDER</th>
                                            <th>NO HP</th>
                                            <th>AKSI</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                         <?php 
                            $dbh = Database::getInstance();
                            $rs = $dbh->query("SELECT * FROM pendaftar WHERE terima='1' and tolak='0'  ");    //where status='0'
    //
                            foreach ($rs as $pendaftar => $list)
                            {
                                echo '<tr class="even gradeC">
                                <td>'.$list['idpendaftar'].'</td>
                                <td>'.$list['nama_ukm'].'</td>
                                <td>'.$list['nim'].'</td>
                                <td>'.$list['nama'].'</td>
                                <td>'.$list['gender'].'</td>
                                <td>'.$list['phone'].'</td>
                                <td><a href="?go=dashboardukmapendaftar-batal&i='.$list['idpendaftar'].' ">Edit</a> </td>      
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
                            DITOLAK
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-semua">
                                    <thead>
                                        <tr>
                                            <th>ID DAFTAR</th>
                                            <th>UKM</th>
                                            <th>NIM</th>
                                            <th>NAMA</th>
                                            <th>GENDER</th>
                                            <th>NO HP</th>
                                            <th>AKSI</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                         <?php 
                            $dbh = Database::getInstance();
                            $rs = $dbh->query("SELECT * FROM pendaftar WHERE terima='0' and tolak='1'  ");    //where status='0'
    //
                            foreach ($rs as $pendaftar => $list)
                            {
                                echo '<tr class="even gradeC">
                                <td>'.$list['idpendaftar'].'</td>
                                <td>'.$list['nama_ukm'].'</td>
                                <td>'.$list['nim'].'</td>
                                <td>'.$list['nama'].'</td>
                                <td>'.$list['gender'].'</td>
                                <td>'.$list['phone'].'</td>
                                <td><a href="?go=dashboardukmapendaftar-batal&i='.$list['idpendaftar'].' ">Edit</a> </td>      
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
                <div class="col-md-4">&nbsp;</div>
            </div>
        </div>
            <!-- /.row -->
            
            
            <!-- /.row -->
            
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
