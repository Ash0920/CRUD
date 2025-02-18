<?php echo validation_errors(); ?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <title>Student_Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <style>
 * {
    box-sizing: border-box;
}

body {
    font-family: Arial, sans-serif;
    background-color: #f0f4f8;
    margin: 0;
    padding: 0;
}

.main-container {
    width: 100%;
    max-width: 1500px;
    margin: 0 auto;
    padding: 20px;
}


.student-details-container {
    width: 100%;
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    margin-bottom: 10px;
}

.header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

.header h2 {
    margin: 0;
}

.add-student-btn {
    padding: 8px 12px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
}

table, th, td {
    border: 1px solid #ddd;
    padding: 10px;
    text-align: left;
}

th {
    background-color: #007bff;
    color: white;
}

button {
    padding: 6px 10px;
    margin: 0 2px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    color: #fff;
}

.view-btn {
    background-color: #0cddd2;
}

.edit-btn {
    background-color: #066916;
}

.delete-btn {
    background-color: #cc0a1d;
}


.container-2 {
    width: 100%;
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}


.student-add-form-container {
    background-color: #f9f9f9;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
}

.student-add-form-container h3 {
    margin-top: 0;
}

label {
    display: block;
    margin: 15px 0 5px;
    font-weight: bold;
}

input[type="text"],
input[type="email"] {
    width: 100%;
    padding: 8px;
    margin-top: 5px;
    border: 1px solid #ddd;
    border-radius: 4px;
}

.save-student-btn {
    width: 100%;
    padding: 10px;
    margin-top: 15px;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}


  </style>
  <body>

  <nav class="navbar navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Student Details</a>
  </div>
    </nav>
   
   
    <div class="main-container">
    <br>
    <br>

    <div class="student-details-container">
        <div class="header">
            <h2>Student Details</h2>
            <button type="button" class="add-student-btn" data-bs-toggle="modal" data-bs-target="#exampleModal">  Add Student
</button>
        </div>
    </div>  
    

    <div class="container-2">
    <table class="table table-striped">
  <thead>

    <tr>
      <th scope="col">ID</th>
      <th scope="col">Student Name</th>
      <th scope="col">Email</th>
      <th scope="col">Phone</th>
      <th scope="col">Course</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
 

  <?php if (!empty($result)): ?>
    <?php foreach ($result as $row): ?>
        <tr>
            <td><?php echo $row->id; ?></td>
            <td><?php echo $row->name; ?></td>
            <td><?php echo $row->email; ?></td>
            <td><?php echo $row->phone; ?></td>
            <td><?php echo $row->course; ?></td>
            <td> 
            <a href="<?php echo site_url('CrudController/edit');?>/<?php echo $row->id;?>" class="btn btn-info">View</a>
              <a href="<?php echo site_url('CrudController/edit');?>/<?php echo $row->id;?>" class="btn btn-success">Edit</a> 
            <a href="<?php echo site_url('CrudController/delete/'.$row->id); ?>" class="btn btn-danger">Delete</a>
</td>
                   
        </tr>
    <?php endforeach; ?>
    <?php else: ?>
    <p>No data available.</p>
<?php endif; ?>

  </tbody>
</table>
    </div>   


   

<!-- Modal -->

 
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Student Add</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form action="<?php echo site_url('CrudController/create')?>" method="post">
    <div class="mb-3">
        <label for="studentName" class="form-label">Student Name</label>
        <input type="text" class="form-control" name="name" value="<?php echo set_value('name'); ?>" required>
        <?php echo form_error('name'); ?>
    </div>
    
    <div class="mb-3">
        <label for="studentEmail" class="form-label">Student Email</label>
        <input type="email" class="form-control" name="email" value="<?php echo set_value('email'); ?>" aria-describedby="emailHelp" required>
        <?php echo form_error('email'); ?>
    </div>
    
    <div class="mb-3">
        <label for="studentPhone" class="form-label">Student Phone</label>
        <input type="number" class="form-control" name="phone" value="<?php echo set_value('phone'); ?>" required>
        <?php echo form_error('phone'); ?>
    </div>
    
    <div class="mb-3">
        <label for="studentCourse" class="form-label">Course</label>
        <input type="text" class="form-control" name="course" value="<?php echo set_value('course'); ?>" required>
        <?php echo form_error('course'); ?>
    </div>
    
    <button type="submit" class="btn btn-primary" value="Save">Save Student</button>
</form>

      </div>
      <div class="modal-footer">
     
      </div>
    </div>
  </div>
</div>



  </body>
</html>