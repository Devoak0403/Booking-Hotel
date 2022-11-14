<div class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                Copyright © 2022. Dashboard by Nopporn J. <a class="badge badge-light badge-pill" data-container="body" data-toggle="popover" data-placement="right" data-content="FB : Nopporn Janwilai OR line : an431">ติดต่อได้ที่ คลิ๊ก!!</a>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="text-md-right footer-links d-none d-sm-block">
                    <a href="javascript: void(0);"> โรงพยาบาลบางปะอิน</a> &nbsp; &nbsp;<i class="fas fa-clock"></i> <span id="datetime2">
                    <!-- <span class="badge badge-success" id="datetime2"> -->
                </div>
            </div>
        </div>
    </div>
</div>

<script>
var dt = new Date();
document.getElementById("datetime").innerHTML = ("วันที่ "+("0"+dt.getDate()).slice(-2)) +"."+ (("0"+(dt.getMonth()+1)).slice(-2)) +"."+ (dt.getFullYear()) +" "+ ("เวลา "+("0"+dt.getHours()).slice(-2)) +":"+ (("0"+dt.getMinutes()).slice(-2));
</script>

<script>
var dt = new Date();
document.getElementById("datetime2").innerHTML = ("วันที่ "+("0"+dt.getDate()).slice(-2)) +"."+ (("0"+(dt.getMonth()+1)).slice(-2)) +"."+ (dt.getFullYear()) +" "+ ("เวลา "+("0"+dt.getHours()).slice(-2)) +":"+ (("0"+dt.getMinutes()).slice(-2));
</script>