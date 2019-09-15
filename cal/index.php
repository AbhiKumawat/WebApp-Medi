<?php
require_once('bdd.php');

session_start();

$user = "None";
if(isset($_SESSION["username"]))
{
	$user = $_SESSION['username'];
	// $_SESSION['userid'] = $_SESSION['userid'];
	$userid = $_SESSION['userid'];
	// echo '<span style="color: black; font-size: 20px;">Welcome ' . $_SESSION['username'] .  ' ,  <br></span>';
	// echo "<script type='text/javascript'>alert('$userid');</script>";
	
}
else
{
	header("Location:../index.html");
}

$sql = "SELECT id, title, start, end, color, type FROM events WHERE userid='$userid'";
$req = $bdd->prepare($sql);
$req->execute();
$events = $req->fetchAll();


$typevalue = 2;
$count = "SELECT * FROM events WHERE userid='$userid' and type='$typevalue'";
$reqPillEvents = $bdd->prepare($count);
$reqPillEvents->execute();

$pillevents = $reqPillEvents->fetchAll();
$pilleventscount = sizeof($pillevents);


// Converting object to associative array 
$pillevents = json_decode(json_encode($pillevents), true); 

	
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
	<meta name="author" content="">
	<link rel="icon" href="favicon.jpg" />

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/demo.css" />
	<link rel="stylesheet" type="text/css" href="css/component.css" />
	<script src="js/modernizr-custom.js"></script>
	
	<title>Your Dashboard</title>
	
	<link rel="stylesheet" href="styles.css">
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<!-- NAVBAR CSS -->
	<link href="css/scrolling-nav.css" rel="stylesheet">

	<!-- FullCalendar -->
	<link href='css/fullcalendar.css' rel='stylesheet' />
</head>

<style>
.container2
{
	padding-top: 10%!important;
}
body {
  min-height: 75rem;
}
</style>
<!-- <body style="background: linear-gradient(to right, #CFD1D7, #6B6B6D);"> -->
<body style="background-color: 	#DEDBDA;">
	<!-- <nav class="navbar navbar-expand-sm bg-light navbar-light fixed-top">
	<img src="logo.PNG" style="height: 50px; width: 10%;">
	</nav> -->
	
	
	<nav class="navbar navbar-expand-lg navbar-light bg-light" style="margin: 0%auto!important;">
		<a class="navbar-brand" href="https://web.njit.edu/~ak979/signin/cal/">MediDispenser</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarTogglerDemo02">
			<ul class="navbar-nav mr-auto mt-2 mt-lg-0">
			<li class="nav-item active">
				<a class="nav-link" href="https://web.njit.edu/~ak979/signin/cal/">Home <span class="sr-only">(current)</span></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#">Contact</a>
			</li>
			<!-- <li class="nav-item">
				<a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
			</li> -->
			</ul>
			<form class="form-inline my-2 my-lg-0" style="float:right!important;">
				<!-- <input class="form-control mr-sm-2" type="search" placeholder="Search">
				<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button> -->
				<?php 
					echo '<a type="button" class="btn-outline-success my-2 my-sm-0 btn bg-danger js-scroll-trigger" style="color:white;" style="margin-top:3%;" href="../logout.php?logout">Logout</a>';
				?> 
			</form>
		</div>
	</nav>


	<!-- Page Content -->
<div class="container-fluid" style="padding-bottom:0%; padding-top:3%;">
	<div class="container db-social">
    <div class="jumbotron jumbotron-fluid"></div>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-xl-6">
                <div class="widget head-profile has-shadow">
                    <div class="bg-light widget-body pb-0">
                        <div class="row d-flex align-items-center">
                            <div class="col-xl-4 col-md-4 d-flex justify-content-lg-start justify-content-md-start justify-content-center">
                            
                            </div>
                            <div class="col-xl-4 col-md-4 d-flex justify-content-center">
                                <div class="image-default">
                                    <img class="rounded-circle" src="avatar.jpg" alt="...">
                                </div>
                                <div class="infos">
                                    <h2 style="color:black;">Abhi Kumawat</h2>
                                    <div class="location" style="color:black;">Jersey City, NJ</div>
                                </div>
                            </div>
                            <div class=" col-xl-4 col-md-4 d-flex justify-content-lg-end justify-content-md-end justify-content-center">
                                <div class="follow">
								
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<ul class="nav nav-tabs" id="myTabs" style="margin:0px auto!important;display: flex;
		justify-content: center;width:80%;" role="tablist">

<li class="nav-item">
    <a class="nav-link" id="navitemsetup" href="#setuptab" role="tab" data-toggle="tab">Setup</a>
  </li>

<li class="nav-item">
    <a class="nav-link" id="navitemcalendar" href="#calendartab" role="tab" data-toggle="tab">Calendar</a>
  </li>

  <li class="nav-item">
    <a class="nav-link" id="navitemsettings" href="#profileinfotab" role="tab" data-toggle="tab">Settings</a>
  </li>
</ul>

<!-- Tab panes -->
<div class="tab-content" style="color:white">
	<div role="tabpanel" id="calendartab" class="tab-pane fade in active" >
		<div class="container-fluid bg-light" style="margin:0px auto!important;display: flex; justify-content: center;">
			<div class="container col-md-8" style="color:black;height:100%!important;width:100%!important;">
				<div class="row">
					<div class="text-center">
						<div id="calendar" class="col-centered">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div role="tabpanel" id="setuptab" class="tab-pane fade">
		<div class="container-fluid bg-light" id="formsetup" style="margin:0px auto!important;display: flex;justify-content: center; color:black">
			<h1 class="" id="setupdes"></h1>
			<div class="col-md-6 container-fluid" >
				<form id="setup" class="form-horizontal" method="POST" action="addSetupEvents.php">
					<div class="modal-header">
						<h4 class="modal-title" id="countPillEvents"></h4>
						<script language="JavaScript">  						
							var jspillcount = <?php echo $pilleventscount ?>;
							// console.log(jspillcount);        
							document.getElementById('countPillEvents').innerHTML = "Setup Pill Container: "+jspillcount".";
						</script>
					</div>
					<div class="modal-body">			
						<div class="form-group">
						<label for="title" class="col-sm-2 control-label">Title</label>
						<div class="col-sm-10">
							<input type="text" name="title" class="form-control" id="title" placeholder="Title">
						</div>
						</div>

						<div class="form-group">
						<label for="type" class="col-sm-2 control-label">Type</label>
						<div class="col-sm-10">
							<select name="type" class="form-control" id="type">
								<!-- <option value="0">Regular Calendar Event</option> -->
								<!-- <option value="1">Pill Event:Not Repeating</option>		 -->
								<option value="2">Pill Event:Repeating</option>		
							</select>
						</div>
						</div>


						<div class="form-group">
						<label for="color" class="col-sm-2 control-label">Color</label>
						<div class="col-sm-10">
							<select name="color" class="form-control" id="color">
								<option value="">Choose</option>
								<option style="color:#0071c5;" value="#0071c5">&#9724; Dark blue</option>
								<option style="color:#40E0D0;" value="#40E0D0">&#9724; Turquoise</option>
								<option style="color:#008000;" value="#008000">&#9724; Green</option>						  
								<option style="color:#FFD700;" value="#FFD700">&#9724; Yellow</option>
								<option style="color:#FF8C00;" value="#FF8C00">&#9724; Orange</option>
								<option style="color:#FF0000;" value="#FF0000">&#9724; Red</option>
								<option style="color:#000;" value="#000">&#9724; Black</option>
								
							</select>
						</div>
						</div>
						
						<div class="form-group">
							<label for="start" class="col-sm-2 control-label">Time</label>
							<div class="col-sm-10">
								<input type="datetime-local" name="start" class="form-control" id="start">
							</div>
						</div>
						<div class="form-group">
							<label for="end" class="col-sm-2 control-label">End date</label>
							<div class="col-sm-10">
								<input type="datetime-local" name="end" class="form-control" id="end">
							</div>
						</div>
						<div class="form-group">
							<label for="start" class="col-sm-2 control-label">Dosage Amount:</label>
							<div class="col-sm-10">
								<select name="color" class="form-control" id="color">
									<option value="">Choose Dosage Amount</option>
									<option value="1">1</option>
									<option value="1">2</option>
									<option value="1">3</option>
									<option value="1">4</option>
								</select>
							</div>
						</div>

					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-dark">Add Recurring Event</button>
					</div>
				</form>
			</div>
		</div>

		<div class="container-fluid bg-light" id="eventslist" style="margin:0px auto!important;display: flex;justify-content: center; color:black">
			<h1>LIST OF PILL EVENTS</h1>
		</div>
	</div>  

	<div role="tabpanel" id="profileinfotab"  class="tab-pane fade" >
	<div class="container-fluid bg-light" id="eventslist" style="margin:0px auto!important;display: flex;justify-content: center; color:black">
			<h1>Edit Your Information</h1>
		</div>
	</div>
</div>



<!-- <div style=" margin:0px auto!important;display: flex;
  justify-content: center;">
	<div class="container col-md-8" style="color:black;height:100%!important;width:100%!important;">
        <div class="row">
            <div class="text-center">
                <div id="calendar" class="col-centered">
                </div>
            </div>
		</div>
	</div>
</div> -->



<!-- CALENDAR MODALS: below -->
	<!--Add Modal -->
	<div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
		<div class="modal-content">
		<form class="form-horizontal" method="POST" action="addEvent.php">
			<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel">Add Event</h4>
			</div>
			<div class="modal-body">
			
				<div class="form-group">
				<label for="title" class="col-sm-2 control-label">Title</label>
				<div class="col-sm-10">
					<input type="text" name="title" class="form-control" id="title" placeholder="Title">
				</div>
				</div>

				<div class="form-group">
				<label for="type" class="col-sm-2 control-label">Type</label>
				<div class="col-sm-10">
					<select name="type" class="form-control" id="type">
						<option value="">Choose</option>
						<option value="0">Regular Calendar Event</option>
						<option value="1">Pill Event:Not Repeating</option>		
						<option value="2">Pill Event:Repeating</option>		
					</select>
				</div>
				</div>


				<div class="form-group">
				<label for="color" class="col-sm-2 control-label">Color</label>
				<div class="col-sm-10">
					<select name="color" class="form-control" id="color">
						<option value="">Choose</option>
						<option style="color:#0071c5;" value="#0071c5">&#9724; Dark blue</option>
						<option style="color:#40E0D0;" value="#40E0D0">&#9724; Turquoise</option>
						<option style="color:#008000;" value="#008000">&#9724; Green</option>						  
						<option style="color:#FFD700;" value="#FFD700">&#9724; Yellow</option>
						<option style="color:#FF8C00;" value="#FF8C00">&#9724; Orange</option>
						<option style="color:#FF0000;" value="#FF0000">&#9724; Red</option>
						<option style="color:#000;" value="#000">&#9724; Black</option>
					</select>
				</div>
				</div>
				
				<div class="form-group">
					<label for="start" class="col-sm-2 control-label">Start date</label>
					<div class="col-sm-10">
						<input type="datetime-local" name="start" class="form-control" id="start">
					</div>
				</div>
				<div class="form-group">
					<label for="end" class="col-sm-2 control-label">End date</label>
					<div class="col-sm-10">
						<input type="datetime-local" name="end" class="form-control" id="end">
					</div>
				</div>
				

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary">Save changes</button>
			</div>
		</form>
		</div>
		</div>
	</div>
	<!-- Edit Modal -->
	<div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<form class="form-horizontal" method="POST" action="editEventTitle.php">
					<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Edit Event</h4>
					</div>
					<div class="modal-body">	
						<div class="form-group">
						<label for="title" class="col-sm-2 control-label">Title</label>
						<div class="col-sm-10">
							<input type="text" name="title" class="form-control" id="title" placeholder="Title">
						</div>
						</div>
						<div class="form-group">
						<label for="color" class="col-sm-2 control-label">Color</label>
						<div class="col-sm-10">
							<select name="color" class="form-control" id="color">
								<option value="">Choose</option>
								<option style="color:#0071c5;" value="#0071c5">&#9724; Dark blue</option>
								<option style="color:#40E0D0;" value="#40E0D0">&#9724; Turquoise</option>
								<option style="color:#008000;" value="#008000">&#9724; Green</option>						  
								<option style="color:#FFD700;" value="#FFD700">&#9724; Yellow</option>
								<option style="color:#FF8C00;" value="#FF8C00">&#9724; Orange</option>
								<option style="color:#FF0000;" value="#FF0000">&#9724; Red</option>
								<option style="color:#000;" value="#000">&#9724; Black</option>			
							</select>
						</div>
						</div>

						<div class="form-group">
						<label for="type" class="col-sm-2 control-label">Type</label>
						<div class="col-sm-10">
							<select name="type" class="form-control" id="type">
								<option value="">Choose</option>
								<option value="0">Regular Event</option>
								<option value="1">Pill Event:Not Repeating</option>		
								<option value="2">Pill Event:Repeating</option>	
							</select>
						</div>
						</div>

						<div class="form-group"> 
							<div class="col-sm-offset-2 col-sm-10">
								<div class="checkbox">
									<label class="text-danger">
										<input type="checkbox"  name="delete"> Delete event</label>
								</div>
							</div>
						</div>
						
						<input type="hidden" name="id" class="form-control" id="id">
					
					
					</div>
					<div class="modal-footer bg-dark" style="">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary">Save changes</button>
					</div>
				</form>
			</div>
		</div>
	</div>


    <!-- jQuery Version 1.11.1 -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
	
	<!-- FullCalendar -->
	<script src='js/moment.min.js'></script>
	<script src='js/fullcalendar.min.js'></script>
	

	<script>
	// formsetup
		var jspillcount = <?php echo $pilleventscount ?>;
		// window.alert(jspillcount);

		var x = document.getElementById("navitemsetup");
		var y = document.getElementById("navitemcalendar");		
		var z = document.getElementById("navitemsettings");
		

		if(jspillcount==7)
		{
			console.log("calendar active")
			x.className === "nav-link";
			
			y.className === "nav-link active";
			$('#myTabs a[href="#calendartab"]').tab('show');
			
			z.className === "nav-link";

			document.getElementById('formsetup').hidden = true;
			document.getElementById('eventslist').hidden = false;
		}
		else
		{
			console.log("setup active")

			x.className === "nav-link active";
			$('#myTabs a[href="#setuptab"]').tab('show');


			y.className === "nav-link";
			z.className === "nav-link";

			document.getElementById('formsetup').hidden = false;
			document.getElementById('eventslist').hidden = true;

		}
		var dt = new Date();
		var date = dt.getFullYear() + '/' + (((dt.getMonth() + 1) < 10) ? '0' : '') + (dt.getMonth() + 1) + '/' + ((dt.getDate() < 10) ? '0' : '') + dt.getDate();
		
		$(document).ready(function() {
			
			$('#calendar').fullCalendar({
				header: {
					left: 'prev,next today',
					center: 'title',
					right: 'month,basicWeek,basicDay'
				},
				defaultDate: date,
				editable: true,
				eventLimit: true, // allow "more" link when too many events
				selectable: true,
				selectHelper: true,
				select: function(start, end) {
					
					$('#ModalAdd #start').val(moment(start).format('YYYY-MM-DD HH:mm:ss'));
					$('#ModalAdd #end').val(moment(end).format('YYYY-MM-DD HH:mm:ss'));
					$('#ModalAdd').modal('show');
				},
				eventRender: function(event, element) {
					element.bind('dblclick', function() {
						$('#ModalEdit #id').val(event.id);
						$('#ModalEdit #title').val(event.title);
						$('#ModalEdit #color').val(event.color);
						$('#ModalEdit #color').val(event.type);
						$('#ModalEdit').modal('show');
					});
				},
				eventDrop: function(event, delta, revertFunc) { // si changement de position

					edit(event);

				},
				eventResize: function(event,dayDelta,minuteDelta,revertFunc) { // si changement de longueur

					edit(event);

				},
				events: [
				<?php foreach($events as $event): 
				
					$start = explode(" ", $event['start']);
					$end = explode(" ", $event['end']);
					if($start[1] == '00:00:00'){
						$start = $start[0];
					}else{
						$start = $event['start'];
					}
					if($end[1] == '00:00:00'){
						$end = $end[0];
					}else{
						$end = $event['end'];
					}
				?>
					{
						id: '<?php echo $event['id']; ?>',
						title: '<?php echo $event['title']; ?>',
						start: '<?php echo $start; ?>',
						end: '<?php echo $end; ?>',
						color: '<?php echo $event['color']; ?>',
					},
				<?php endforeach; ?>
				]
			});
			
			function edit(event){
				start = event.start.format('YYYY-MM-DD HH:mm:ss');
				if(event.end){
					end = event.end.format('YYYY-MM-DD HH:mm:ss');
				}else{
					end = start;
				}
				
				id =  event.id;
				
				Event = [];
				Event[0] = id;
				Event[1] = start;
				Event[2] = end;
				
				$.ajax({
				url: 'editEventDate.php',
				type: "POST",
				data: {Event:Event},
				success: function(rep) {
						if(rep == 'OK'){
							alert('Saved');
						}else{
							alert('Could not be saved. try again.'); 
						}
					}
				});
			}
			
		});
	</script>
	<!-- Footer -->
	<!-- <footer class="py-5">
		<p class="m-0 text-center text-black" style="width:100%; font-size:15px;">Copyright &copy; MediPD 2019</p>
	</footer> -->
	
</body>

<footer id="sticky-footer" class="py-5 bg-light text-black-50">
		<div class="text-center" style="color:black;">
		<small>Copyright &copy; MediDispenser</small>
		</div>
  </footer>
  
</html>
