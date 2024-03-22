$(document).ready(function(){
    $("#login_form").submit(function(event){
        event.preventDefault();
        
        var email = $('#email').val();
        var password = $('#password').val();

        $.ajax({
            url: "php/login.php",
            type: "POST", 
            data:  {email: email, password: password },
            success: function(data){
                console.log(data); 
                if (data.trim() === "LOGGED IN SUCCESSFULLY") {
                    localStorage.setItem("User_email",email);
                    alert("LOGGED IN SUCCESSFULLY");
                    window.location.href = "profile.html";
                } else {
                    alert(data); 
                }           
            },
        });
    });
});

