<!-- displays the current session's orders cart -->

<!-- to make session -->
<?php session_start(); ?>

    
<!-- connects to database -->
<?php
    #file that has db connection
    include "db-connection.php";
    
    #runs the open connection function
    $conn = OpenConnection();
    // echo "Connected Successfully";
    echo "<script>console.log('Database Connected Successful');</script>";
?>

<?php
                    // itemID  array(quantity[0], subtotal[1]) 
// print_r($_SESSION["cart"][16][0]);


echo
"
<table border='1'>
        <th>Image</th>
        <th>Name</th>
        <th>Food Type</th>
        <th>Quantity</th>
        <th>Price</th>
";

$totalArray = array();

foreach($_SESSION["cart"] as $key => $val){
    $sql = "SELECT * FROM menuitems WHERE ID= '$key'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    // changes foodType from number to its actual name
    $foodCategoryName = "";
    if($row["foodCategory"] == 1){
        $foodCategoryName = "Main Course";
    }
    elseif($row["foodCategory"] == 2){
        $foodCategoryName = "Dessert";
    }
    elseif($row["foodCategory"] == 3){
        $foodCategoryName = "Appetizer";
    }
    elseif($row["foodCategory"] == 4){
        $foodCategoryName = "Drink";
    }

    // get subtotal
    $subtotal = $_SESSION["cart"][$key][1];
    array_push($totalArray, $subtotal);

    echo
    "
        <tr>
            <td><img src='admin/add_menu_item/img/{$row['image']}' width='200'></td>
            <td>{$row['foodName']}</td>
            <td>{$foodCategoryName}</td>
            <td>{$_SESSION["cart"][$key][0]}</td>
            <td>{$subtotal}</td>
        </tr>
    ";
}
$grandTotal = array_sum($totalArray);
echo 
"
<tr>
    <td align='right' colspan='5'>{$grandTotal} LE</td>
</tr>
</table>
";

echo "<a href='checkout-process.php'><button style='margin-left: 435px'> CheckOut </button></a>";
?>


<?php
    #runs the close connection function
    CloseConnection($conn);
?>