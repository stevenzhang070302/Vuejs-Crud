<!DOCTYPE html>
<html>
<head>
	<title>University Signup Page</title>

	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

</head>
<body>
	<style type="text/css">
		#overlay{
			position: fixed;
			top: 0;
			bottom: 0;
			left: 0;
			right: 0;
			background: rgba(0,0,0,0.6);
		}

	</style>
	<div id="app">
		<div class="container-fluid">
			<div class="row bg-dark">
				<div class="col-lg-12">
					<p class="text-center text-light display-4 pt-2" style="font-size: 25px;">University Signup</p>
				</div>
			</div>
		</div>

		<div class="container">
			<div class="row mt-3">
				<div class="col-lg-6">
					<h3 class="text-info">Enter User Details</h3>
				</div>
				<div class="col-lg-6">
					<button class="btn btn-info float-right" @click="showAddModal = true">
						<i class="fa fa-user"> Add New Detail</i>
					</button>
				</div>
			</div>
			<hr class="bg-info">
			<div class="alert alert-danger" v-if="errorMsg">
				{{errorMsg}}
			</div>
			<div class="alert alert-success" v-if="successMsg">
				{{successMsg}}
			</div>

			<div class="row">
				<div class="col-lg-12">
					<table class="table table-bordered table-striped">
						<thead class="text-center bg-info text-light">
							<th>Student ID</th>
							<th>Student Name</th>
							<th>University Name</th>
							<th>Exam Mark 1</th>
							<th>Exam Mark Average</th>
							<th>Action</th>
						</thead>
						<tbody>
							<tr class="text-center" v-for="user in users">
								<td>{{ user.id }}</td>
								<td>{{ user.name }}</td>
								<td>{{ user.university }}</td>
								<td>{{ user.examone }}</td>
								<td>{{ user.examaverage }}</td>
								<td>
									<a href="#" class="text-success" @click="showEditModal = true; selectUser(user);"><i class="fa fa-edit"></i></a>
									|
									<a href="#" class="text-danger" @click="showDeleteModal = true; selectUser(user);"><i class="fa fa-trash"></i></a>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>

		<!-- show add modal popup -->
		<div id="overlay" v-if="showAddModal">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Add New User</h5>
						<button type="button" class="close" @click="showAddModal = false">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body p-4">
						<form action="#" method="POST">
							<div class="form-group">
								<input type="text" name="id" class="form-control form-control-lg" placeholder="Enter ID" v-model="newUser.id">
							</div>
							<div class="form-group">
								<input type="text" name="name" class="form-control form-control-lg" placeholder="Enter Name" v-model="newUser.name">
							</div>
							<div class="form-group">
								<input type="text" name="university" class="form-control form-control-lg" placeholder="Enter University" v-model="newUser.university">
							</div>
							<div class="form-group">
								<input type="number" name="examone" class="form-control form-control-lg" placeholder="Enter Exam One Score" v-model="newUser.examone">
							</div>
							<div class="form-group">
								<input type="text" name="examaverage" class="form-control form-control-lg" placeholder="Enter Exam Average Score" v-model="newUser.examaverage">
							</div>
							<div class="form-group">
								<button class="btn btn-success btn-block btn-lg" @click="showAddModal = false; addUser(); clearMsg();">Add User</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

		<!-- edit add modal popup -->
		<div id="overlay" v-if="showEditModal">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Edit User</h5>
						<button type="button" class="close" @click="showEditModal = false">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body p-4">
						<form action="#" method="POST">
							<input type="hidden" name="id" v-model="currentUser.id">
							<div class="form-group">
								<input type="text" name="name" class="form-control form-control-lg" v-model="currentUser.name">
							</div>
							<div class="form-group">
								<input type="text" name="university" class="form-control form-control-lg" v-model="currentUser.university">
							</div>
							<div class="form-group">
								<input type="number" name="examone" class="form-control form-control-lg" v-model="currentUser.examone">
							</div>
							<div class="form-group">
								<input type="text" name="examaverage" class="form-control form-control-lg" v-model="currentUser.examaverage">
							</div>
							<div class="form-group">
								<button class="btn btn-success btn-block btn-lg" @click="showEditModal = false; updateUser(); clearMsg();">Update User</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

		<!-- delete add modal popup -->
		<div id="overlay" v-if="showDeleteModal">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Delete User</h5>
						<button type="button" class="close" @click="showDeleteModal = false">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body p-4">
						<h4 class="text-danger">Are you Sure want to Delete?</h4>
						<h5>You are deleting '{{ currentUser.name }}'</h5>
						<hr>
						<button class="btn btn-danger btn-lg" @click="showDeleteModal = false; deleteUser(); clearMsg();"> Yes</button>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<button class="btn btn-default btn-lg" @click="showDeleteModal = false"> No</button>
					</div>
				</div>
			</div>
		</div>
	</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.0/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vue"></script>
<script>
	var app = new Vue({
		el: '#app',
		data: {
			errorMsg : "",
			successMsg : "",
			showAddModal : false,
			showEditModal : false,
			showDeleteModal : false,
			users : [],
			newUser : {id: "", name: "", university: "", examone: "", examaverage: ""},
			currentUser : {},
			// a : 1
		},
		mounted: function(){
			this.getAllUser();
			// this.a+1;
		},
		methods: {
			getAllUser(){
				axios.get("http://localhost/model.php?action=read").then(function(response){
					if(response.data.error){
						app.errorMsg = response.data.message;
					}
					else{
						app.users = response.data.users;
					}
				});
			},
			addUser(){
				var formData = app.toFormData(app.newUser);
				axios.post("http://localhost/model.php?action=create", formData).then(function(response){
					app.newUser = {id: "", name: "", university: "", examone: "", examaverage: ""};
					if(response.data.error){
						app.errorMsg = response.data.message;
					}
					else{
						app.successMsg = response.data.message;
						app.getAllUser();
					}
				});
			},
			updateUser(){
				var formData = app.toFormData(app.currentUser);
				axios.post("http://localhost/model.php?action=update", formData).then(function(response){
					app.currentUser = {};
					if(response.data.error){
						app.errorMsg = response.data.message;
					}
					else{
						app.successMsg = response.data.message;
						app.getAllUser();
					}
				});
			},
			deleteUser(){
				var formData = app.toFormData(app.currentUser);
				axios.post("http://localhost/model.php?action=delete", formData).then(function(response){
					app.currentUser = {};
					if(response.data.error){
						app.errorMsg = response.data.message;
					}
					else{
						app.successMsg = response.data.message;
						app.getAllUser();
					}
				});
			},
			toFormData(obj){
				var fd = new FormData();
				for(var i in obj){
					fd.append(i, obj[i]);
				}
				return fd;
			},
			selectUser(user){
				app.currentUser = user;
			},
			clearMsg(){
				app.errorMsg = "";
				app.successMsg = "";
			}
		}
	});
</script>
</body>
</html>