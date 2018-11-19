<?php
/*
 * Template Name:Головна
 *
 */
?>
<?php get_header();
global $mytheme, $post;
?>



<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item"><a href="#">Library</a></li>
        <li class="breadcrumb-item active" aria-current="page">Data</li>
    </ol>
</nav>
<section class="container ">
    <div class="pagination-content">
        <div class="pagination-content-arrow">
            <img src="img/left-arrow-icon.png" alt="arrow">
        </div>
        <ul class="pagination pagination-list">
            <li class="pagination-item"><a class="pagination-item-link" href="#">1</a></li>
            <li class="pagination-item"><a class="pagination-item-link" href="#">2</a></li>
            <li class="pagination-item"><a class="pagination-item-link" href="#">3</a></li>
            <li class="pagination-item"><a class="pagination-item-link" href="#">...</a></li>
            <li class="pagination-item"><a class="pagination-item-link" href="#">20</a></li>
        </ul>
        <div class="pagination-content-arrow">
            <img src="img/right-arrow-icon.png" alt="arrow">
        </div>
    </div>
</section>
<section class="contacts container">
    <div class="contacts-img"><img src="img/contactImg.png" class=""></div>
    <div class="contact-form">
        <h2 class="contractForm-form-header">CONTACT US</h2>
        <form class="">
            <div class="form-inline form-blog">
                <div class="form-group"><input required="" placeholder="Your Name" name="nameUser" type="text" class="form-input form-control"
                                               value=""></div>
                <div class="form-group"><input required="" placeholder="Company" name="companyUser" type="text" class="form-input form-control"
                                               value=""></div>
            </div>
            <div class="form-inline form-blog">
                <div class="form-group"><input required="" placeholder="Phone Number" name="phoneUser" type="text" class="form-input form-control"
                                               value=""></div>
                <div class="form-group"><input required="" placeholder="Email" name="emailUser" type="text" class="form-input form-control"
                                               value=""></div>
            </div><textarea placeholder="Message" class="form-textarea form-control"></textarea><button type="submit" class="content-btn btn btn-default">SEND</button>
        </form>
    </div>
</section>


<?php get_footer();

?>
