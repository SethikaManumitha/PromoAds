<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/role.css') }}">
</head>

<body>

    <div class="role-container">
        <center>
            <h1>Who Are You?</h1>
        </center>
        <br>
        <div class="container role-selection">
            <div class="row">
                <div class="col-md-4">
                    <div class="role-card" onclick="selectRole(this)">
                        <div class="role-icon">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="role-label" id="Customer">
                            I am a client looking for services or products.
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="role-card" onclick="selectRole(this)">
                        <div class="role-icon">
                            <i class="fas fa-briefcase"></i>
                        </div>
                        <div class="role-label" id="Business">
                            I am a business offering services or products.
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="role-card" onclick="selectRole(this)">
                        <div class="role-icon">
                            <i class="fas fa-truck"></i>
                        </div>
                        <div class="role-label" id="Driver">
                            I am a driver ready to fulfill delivery or transportation tasks.
                        </div>
                    </div>
                </div>
            </div>


            <button class="continue-btn" id="continueBtn" disabled>Continue</button>
        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script>
        const continueBtn = document.getElementById('continueBtn');
        let selectedRole = null;

        function selectRole(card) {
            document.querySelectorAll('.role-card').forEach((card) => {
                card.classList.remove('active');
            });

            card.classList.add('active');
            continueBtn.disabled = false;
            selectedRole = card.querySelector('.role-label').id;

            continueBtn.textContent = `Continue as a ${selectedRole}`;
        }

        continueBtn.addEventListener('click', () => {
            if (selectedRole === 'Customer') {
                window.location.href = "{{ route('customerSignUp') }}";
            } else if (selectedRole === 'Business') {
                window.location.href = "{{ route('businessSignUp') }}";
            } else if (selectedRole === 'Driver') {
                window.location.href = "{{ route('driverSignUp') }}";
            }
        });
    </script>



</body>

</html>