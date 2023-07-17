<?php
include('config.php');
$query = "SELECT pt_ID, pt_fname, pt_lname, pt_age, pt_address FROM patients";
$result = mysqli_query($conn, $query);
?>
<head>
  <link rel="stylesheet" href="style2.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.11.2/css/jquery.dataTables.min.css">
  <script src="https://cdn.datatables.net/1.11.2/js/jquery.dataTables.min.js"></script>
  <style>
    .pagination {
      display: inline-block;
    }
    .pagination a {
      color: black;
      float: left;
      padding: 8px 16px;
      text-decoration: none;
      border: 1px solid #ddd;
      margin: 0 4px;
    }
    .pagination a.active {
      background-color: #4CAF50;
      color: white;
      border: 1px solid #4CAF50;
    }
    .pagination a:hover:not(.active) {
      background-color: #ddd;
    }
    .action{
    margin: 10px; 
    font-size: medium; 
    cursor: pointer; 
    padding:10px; 
}
  </style>
</head>
<body>
  <button class="action" ><a style="color: black;" href="add_patients.php">Add Patient</a></button>
  
  <table border ="1" cellspacing="0" cellpadding="10" id="myTable">
    <tr>
      <th>S.N</th>
      <th>First Name</th>
      <th>Last Name</th>
      <th>Age</th>
      <th>Address</th>
      <th>Action</th>
    </tr>
    <?php
       if (isset($_POST['delete'])) {
        $id = $_POST['delete'];
        $query = "DELETE FROM patients WHERE pt_ID = '$id'";
        mysqli_query($conn, $query);
      }
       // Handle update button click
    if (isset($_POST['update'])) {
      $id = $_POST['update'];
      header("Location: update_page.php?id=$id");
      exit();
    }

if (mysqli_num_rows($result) > 0) {
  while($data = mysqli_fetch_assoc($result)) {
    ?>
 <tr>
   <td><?php echo $data['pt_ID']; ?> </td>
   <td><?php echo $data['pt_fname']; ?> </td>
   <td><?php echo $data['pt_lname']; ?> </td>
   <td><?php echo $data['pt_age']; ?> </td>
   <td><?php echo $data['pt_address']; ?> </td>
   <td><form method='POST' onsubmit="return confirm('Are you sure you want to modify this record?')">
              <button type='submit' name='delete' value="<?php echo $data['pt_ID']; ?> "  class="action">Delete</button>
              <button type='submit' name='update' value="<?php echo $data['pt_ID']; ?> " class="action">Update</button>
              </form></td>
 <tr>
   <?php
  ;}} else { ?>
    <tr>
     <td colspan="8">No data found</td>
    </tr>
    
    <?php } ?>
  </table>
  <div class="pagination"></div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
    // Number of rows per page
    var rowsPerPage = 20;
  
    // Calculate total number of pages
    var totalRows = $('#myTable tbody tr').length;
    var totalPages = Math.ceil(totalRows / rowsPerPage);
  
    // Generate pagination links
    var paginationHTML = '';
    for (var i = 1; i <= totalPages; i++) {
      paginationHTML += '<a href="#" data-page="' + i + '">' + i + '</a>';
    }
    $('.pagination').html(paginationHTML);
  
    // Show the first page by default
    showPage(1);
  
    // Handle pagination link clicks
    $('.pagination a').click(function(e) {
      e.preventDefault();
      var page = $(this).data('page');
      showPage(page);
    });
  
    // Function to display the selected page
    function showPage(page) {
      // Hide all rows
      $('#myTable tbody tr').hide();
  
      // Calculate starting and ending row index
      var startIndex = (page - 1) * rowsPerPage;
      var endIndex = startIndex + rowsPerPage - 1;
  
      // Show the selected rows
      $('#myTable tbody tr').slice(startIndex, endIndex + 1).show();
  
      // Update active link
      $('.pagination a').removeClass('active');
      $('.pagination a[data-page="' + page + '"]').addClass('active');
    }
  });
</script>
</body>
