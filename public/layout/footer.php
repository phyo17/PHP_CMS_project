<!-- Footer -->
<footer>
    <div class="container">
        <div class="col-md-4" >
            <h3>Gallery Posts</h3>
                <div class="row">
                  <?php 
                    $query = "SELECT * FROM `post` WHERE status='Public' ORDER BY id DESC LIMIT 6";
                    $data = mysqli_query($connect,$query);
                    foreach($data as $value){
                   ?>
                      <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3" style="margin-left: 7px; margin-bottom: 3px">
                         <div class="gallery-image">
                           <img src="../photo/<?php echo $value['image'] ?>" alt="image view" width="100px" height="80px">
                         </div>
                      </div>
                  <?php 
                    }
                   ?>
                </div>
        </div>
        
        <div class="col-md-4">
            <h3>Our Location </h3>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d118427.04428214587!2d96.00578352752643!3d21.940504297496574!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30cb6d23f0d27411%3A0x24146be01e4e5646!2sMandalay!5e0!3m2!1sen!2smm!4v1598153634821!5m2!1sen!2smm" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
        </div>
        <div class="col-md-4" >
            <h3>Contact Us</h3>
            <ul>
                <li>Phone : 123 - 456 - 789</li>
                <li>E-mail : info@comapyn.com</li>
                <li>Address : Yangon, ThinGanGyun</li>
            </ul>
            <hr>

            <div class="myicon">
                <a href="#" ><i class="fa fa-facebook-square" aria-hidden="true"></i></a>
                <a href="#" ><i class="fa fa-google-plus-square" aria-hidden="true"></i></a>
                <a href="#"><i class="fa fa-twitter-square" aria-hidden="true"></i></a>
            </div>

        </div>
    </div>

            <!-- /.row -->
</footer>

    <div class="row">
        <div class="col-lg-12">
            <p>Copyright &copy; Your Website 2020</p>
        </div>
        <!-- /.col-lg-12 -->
    </div>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>