$(document).ready(function() {
    var email=localStorage.getItem('User_email');
    
    $.ajax({
        url: 'php/profile.php',
        type : 'GET',
        data : {
            email : email
        },
        // dataType:'json',
        success : function(response){
            var user_details=JSON.parse(response);
            console.log(user_details.User_name);
            document.querySelector('#my-form input[name="email"]').value = user_details.Email;
            document.querySelector('#my-form input[name="name"]').value = user_details.User_name;
            document.querySelector('#my-form input[name="dob"]').value=user_details.dob;
            document.querySelector('#my-form input[name="age"]').value=user_details.age;
            document.querySelector('#my-form input[name="contact"]').value=user_details.contact;
       },
        error : function(xhr, status, error){
            console.log('Error: '+ error);
        }
    });



    $('#updateForm').submit(function(e) {
        e.preventDefault(); 
        console.log("function called");
        var formData = $(this).serialize();
        formData += '&email=' + encodeURIComponent(email);
        console.log(formData)
    
        
        console.log(formData);
        $.ajax({
            type: 'POST',
            url: 'php/profile.php',
            data: formData,
            success: function(response) {
                console.log(response); 
            },
            error: function(xhr, status, error) {
                console.error("Error updating user profile:", error);
            }
        });
    });
});






