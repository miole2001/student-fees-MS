<?php
// Database connection (Assuming you have a working connection)
include("db_connection.php");

// Get payment details from the form submission
$user_id = $_POST['user_id']; // User ID making the payment
$payment_amount = $_POST['payment_amount']; // Payment amount entered by the user

// Check if the payment amount is valid
if ($payment_amount > 0) {
    // Start transaction (Optional, just to ensure all operations happen together)
    $connection->begin_transaction();

    // Step 1: Get current remaining balance from the user's bill
    $sql = "SELECT remaining_balance FROM bills WHERE user_id = $user_id";
    $result = $connection->query($sql);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $remaining_balance = $row['remaining_balance'];

        // Step 2: Check if the payment amount is greater than the remaining balance
        if ($payment_amount > $remaining_balance) {
            echo "Payment exceeds the remaining balance.";
        } else {
            // Step 3: Deduct the payment from the remaining balance
            $new_remaining_balance = $remaining_balance - $payment_amount;

            // Update the bill with the new remaining balance
            $update_sql = "UPDATE bills SET remaining_balance = $new_remaining_balance WHERE user_id = $user_id";
            if ($connection->query($update_sql) === TRUE) {
                
                // Step 4: Insert the payment into the payments table
                $payment_date = date("Y-m-d H:i:s");  // Get current timestamp
                $insert_payment_sql = "INSERT INTO payments (user_id, payment_amount, payment_date) 
                                       VALUES ($user_id, $payment_amount, '$payment_date')";
                if ($connection->query($insert_payment_sql) === TRUE) {
                    echo "Payment successfully processed. Remaining balance: $new_remaining_balance";
                } else {
                    echo "Error recording the payment.";
                }
            } else {
                echo "Error updating the remaining balance.";
            }
        }
    } else {
        echo "No bill found for the user.";
    }

    // Commit transaction
    $connection->commit();
} else {
    echo "Invalid payment amount.";
}

$connection->close();
?>

<form method="POST" action="process_payment.php">
    <label for="user_id">User ID:</label>
    <input type="number" name="user_id" required>
    
    <label for="payment_amount">Payment Amount:</label>
    <input type="number" step="0.01" name="payment_amount" required>
    
    <button type="submit">Pay</button>
</form>
