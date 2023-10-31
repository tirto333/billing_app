<script>
    var currentTime = new Date();
    var currentHour = currentTime.getHours();
    var greeting;                                  
    if (currentHour < 12) {
      greeting = "Pagi";
    } else if (currentHour < 18) {
      greeting = "Sore";
    } else {
      greeting = "Malam";
    }            
    document.write(greeting);
</script>, {{Auth::user()->first_name}} {{Auth::user()->last_name}} !