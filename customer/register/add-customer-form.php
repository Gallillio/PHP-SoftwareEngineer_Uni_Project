<!-- This is page to add customer (register) -->

<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Register</title>
        <link rel="stylesheet" href="style.css">

        <!-- so that the arrow that shows beside number input doesn't show -->
        <style>
            input::-webkit-outer-spin-button,
            input::-webkit-inner-spin-button {
                -webkit-appearance: none;
                margin: 0;
            }
        </style>
    </head>
    <body>
        <header>
            <h3 class="title">Foul court <a href="../../" style="color: red;"> (Click Here to return to index)</a></h3>
        </header>
        <div class="container">
            <div class="btn">
                <div class="login">Register</div>
            </div>
            
            <!-- Form -->
            <form action="send-register-customer-data.php" method="post">
                <div class="form-section">
                    <!-- Register Account -->
                    <div class="enter-box">
                        <input type="text"
                            class="name ele"
                            name="employeeUsername"
                            placeholder="Enter Username" required>
                        <input type="email"
                            class="email ele"
                            name="employeeEmail"
                            placeholder="youremail@email.com" required>
                        <input type="password"
                            class="password ele"
                            name="employeePassword"
                            placeholder="password" required>
                        <input type="number"
                            class="password ele"
                            name="employeeAge"
                            placeholder="Enter your age " required>
                        <input type="text"
                            class="password ele"
                            name="employeeAddress"
                            placeholder="Enter your address" required>
                        <input type="number"
                            class="password ele"
                            name="employeePhone"
                            placeholder="Enter your phone number" required>
                        <div style="color: white;">
                            Gender:
                            Male <input type="radio" name="employeeGender" value="m" required> Female <input type="radio" name="employeeGender" value="f" required>
                        </div>
                        <button class="clkbtn">Create Account</button>
                    </div>
                </div>
            </form> 
        </div>
    </body>
</html>

