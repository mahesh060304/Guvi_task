 $(document).ready(function(){
    $("#register_form").submit(function(event){
        event.preventDefault();     
        
        var username=$('#username').val();
        var email=$('#email').val();
        var password=$('#password').val();

        
        $.ajax({
            url: "php/register.php",
            type: "POST", 
            data: {username:username,email:email,password:password},
            success: function(data){
                console.log(data); 
                if (data.trim() === "REGISTERED SUCCESSFULLY") {
                    alert("REGISTERED SUCCESSFULLY");
                    window.location.href = "login.html";
                } else {
                    alert(data); 
                }
            },
        });

    });
});
