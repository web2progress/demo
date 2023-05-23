 <div class="sticky-side">
     <!-- Category Start -->
     <div class="mb-5 wow slideInUp" data-wow-delay="0.1s">
         <div class="connected mt-2 aos-init aos-animate" data-aos="fade-up" data-aos-duration="600" data-aos-offset="50">
             <p>Categories</p>
         </div>
         <div class="tags_content d-flex flex-column justify-content-start">
             @if (!empty($productCategories))
                 @foreach ($productCategories as $productCategory)
                     <a class="h5 fw-semi-bold rounded  d-flex justify-content-between"
                         href="/product-category/{{ $productCategory->product_cat_slug }}">
                         <span><i class="bi bi-arrow-right me-2"></i>
                             {{ $productCategory->product_cat_title }}</span>
                         <span class="countDta">
                             {{ App\Models\Product::where('product_cat', 'LIKE','%'.$productCategory->id.'%')->where('status', 'publish')->count() }}
                         </span>
                     </a>
                 @endforeach
             @endif
         </div>
     </div>
 </div>
