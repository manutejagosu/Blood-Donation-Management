<?php
include("connect.php");   
$sql = "SELECT * FROM donor";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    echo "<table border='1'>";
    echo "<tr>
            <th>ID</th>
            <th>Full Name</th>
            <th>Age</th>
            <th>Gender</th>
            <th>Blood Group</th>
            <th>Mobile</th>
            <th>City</th>
            <th>Last Donation Date</th>
          </tr>";

    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>".$row['id']."</td>
                <td>".$row['full_name']."</td>
                <td>".$row['age']."</td>
                <td>".$row['gender']."</td>
                <td>".$row['blood_group']."</td>
                <td>".$row['mobile_number']."</td>
                <td>".$row['city']."</td>
                <td>".$row['last_donation_date']."</td>
              </tr>";
    }

    echo "</table>";
} else {
    echo "No donors found";
}

$conn->close();
?>