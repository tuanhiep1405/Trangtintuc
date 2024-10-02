 <!-- Footer Start -->
 <footer id="footer" class="footer">
     <div class="utf_footer_main">
         <div class="container">
             <div class="row">
                 <div class="col-lg-4 col-sm-12 col-xs-12 footer-widget contact-widget">
                     <h3 class="widget-title">About</h3>
                     <ul>
                         <li>
                            Vietnamese newspaper has the most views
                            Belongs to the Ministry of Science and Technology
                            License number: 999/GP-BTTTT dated June 02, 2024
                         </li>
                         <li>
                             <i class="fa fa-home"></i> 15 Nguyen Si Sach, Tan Binh, Ho Chi Minh
                         </li>
                         <li>
                             <i class="fa fa-phone"></i> <a href="#!">+84 999 868 686</a>
                         </li>
                         <li>
                             <i class="fa fa-envelope-o"></i>
                             <a href="#!">{{ $_SESSION['settings']['email'] }}</a>
                         </li>
                     </ul>
                     <ul class="unstyled utf_footer_social">
                         <li>
                             <a title="Facebook" href="!#"><i class="fa fa-facebook"></i></a>
                         </li>
                         <li>
                             <a title="Twitter" href="!#"><i class="fa fa-twitter"></i></a>
                         </li>
                         <li>
                             <a title="Google+" href="!#"><i class="fa fa-google-plus"></i></a>
                         </li>
                         <li>
                             <a title="Linkdin" href="!#"><i class="fa fa-linkedin"></i></a>
                         </li>
                         <li>
                             <a title="Skype" href="!#"><i class="fa fa-skype"></i></a>
                         </li>
                         <li>
                             <a title="Skype" href="!#"><i class="fa fa-instagram"></i></a>
                         </li>
                     </ul>
                 </div>

                 <div class="col-lg-4 col-sm-12 col-xs-12 footer-widget widget-categories">
                     <h3 class="widget-title">POPULAR CATEGORIES</h3>
                     <ul>
                        @php
                            $totalPostInCategories = (new Assignment\Php2News\Models\Categories)->getTotalPostInCategory();
                        @endphp
                        @foreach ($totalPostInCategories as $category)
                            <li>
                                <i class="fa fa-angle-double-right"></i>
                                <a href="/detail-category/{{ $category['id'] }}">
                                    <span class="catTitle">{{ $category['nameCategory'] }}</span>
                                    <span class="catCounter"> ({{ $category['totalPost'] }})</span>
                                </a>
                            </li>
                        @endforeach
                     </ul>
                 </div>

                 <div class="col-lg-4 col-sm-12 col-xs-12 footer-widget">
                     <h3 class="widget-title">POPULAR NEWS</h3>
                     <div class="utf_list_post_block">
                         <ul class="utf_list_post">
                            @php
                                $top3PostViewHighest = (new Assignment\Php2News\Models\Posts)->getTopNewPopuler();
                            @endphp
                            @foreach ($top3PostViewHighest as $item)
                                <li class="clearfix">
                                    <div class="utf_post_block_style post-float clearfix">
                                        <div class="utf_post_thumb">
                                            <a href="#!">
                                                <img
                                                    class="img-fluid"
                                                    src="/assets/{{ $item['image'] }}"
                                                    alt="image new"
                                                />
                                            </a>
                                        </div>
                                        <div class="utf_post_content">
                                            <h2 class="utf_post_title title-small">
                                                <a href="/detail-post/{{ $item['id'] }}">{{ $item['title'] }}</a>
                                            </h2>
                                            <div class="utf_post_meta">
                                                <span class="utf_post_date">
                                                    <i class="fa fa-clock-o"></i>
                                                    {{ $item['date'] }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                         </ul>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </footer>
 <!-- Footer End -->

 <!-- Copyright Start -->
 <div class="copyright">
     <div class="container">
         <div class="row">
             <div class="col-sm-12 col-md-12 text-center">
                 <div class="utf_copyright_info">
                     <span>Copyright © 2024 By Group Thich-An-Rau.</span>
                 </div>
             </div>
         </div>
         <div id="back-to-top" class="back-to-top">
             <button class="btn btn-primary" title="Back to Top">
                 <i class="fa fa-angle-up"></i>
             </button>
         </div>
     </div>
 </div>
 <!-- Copyright End -->
 </div>
