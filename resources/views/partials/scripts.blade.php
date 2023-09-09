<!-- Back to Top -->
<a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top">
    <i class="bi bi-arrow-up"></i>
</a>

<!-- JavaScript Libraries -->
<script src="{{ asset('code.jquery.com/jquery-3.6.4.min.js') }}"></script>
<script src="{{ asset('cdn.jsdelivr.net/npm/bootstrap%405.0.0/dist/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('lib/wow/wow.min.js') }}"></script>
<script src="{{ asset('lib/easing/easing.min.js') }}"></script>
<script src="{{ asset('lib/waypoints/waypoints.min.js') }}"></script>
<script src="{{ asset('lib/owlcarousel/owl.carousel.min.js') }}"></script>
<script src="{{ asset('lib/counterup/counterup.min.js') }}"></script>

<script src='//cdnjs.cloudflare.com/ajax/libs/pdf.js/2.0.550/pdf.min.js'></script>
<script src='//cdnjs.cloudflare.com/ajax/libs/pdf.js/2.0.550/pdf.worker.min.js'></script>

<!-- Template Javascript -->
<script src="{{ asset('js/kms/main.js') }}"></script>
<script>
var $owl = $('.loop');

$owl.owlCarousel({
    autoplay: true,
    autoplayHoverPause: true,
    autoplayTimeout: 2500,
    autoplaySpeed: 800,
    center: true,
    items: 1.4,
    stagePadding: 15,
    loop: true,
    margin: 15,
    animateOut: 'slide-up',
    animateIn: 'slide-down',
});

$(function() {
    let pdfDoc = null,
        pageNum = 1,
        pageRendering = false,
        pageNumPending = null;
  
    const scale = 5.0,
          canvas = document.getElementById('pdf-canvas'),
          pnum = document.getElementById('page-num')
          ctx = canvas.getContext('2d');
  
    /**
     * Get page info from document, resize canvas accordingly, and render page.
     * @param num Page number.
     */
    function renderPage(num) {
      pageRendering = true;
      
      // Using promise to fetch the page
      pdfDoc.getPage(num).then(function(page) {
        const page_viewport = page.getViewport(scale);
        canvas.height = page_viewport.height;
        canvas.width = page_viewport.width;
  
        // Render PDF page into canvas context
        const renderContext = {
          canvasContext: ctx,
          viewport: page_viewport
        };
        const renderTask = page.render(renderContext);
  
        // Wait for rendering to finish
        renderTask.promise.then(function() {
          pageRendering = false;
          if (pageNumPending !== null) {
            // New page rendering is pending
            renderPage(pageNumPending);
            pageNumPending = null;
          }
        });
      });
  
      // Update page counters
      $(pnum).text(num);
    }
  
    /**
     * If another page rendering in progress, waits until the rendering is
     * finised. Otherwise, executes rendering immediately.
     */
    function queueRenderPage(num) {
      if (pageRendering) {
        pageNumPending = num;
      } else {
        renderPage(num);
      }
    }
  
    /**
     * Displays previous page.
     */
    $(".carousel-control-prev").click(function() {
      if (pageNum > 1) {
        pageNum--;
        queueRenderPage(pageNum);
      }
    });
  
    /**
     * Displays next page.
     */
    $(".carousel-control-next").click(function() {
      if (pageNum < pdfDoc.numPages) {
        pageNum++;
        queueRenderPage(pageNum);
      }
    });
  
    /**
     * Asynchronously downloads PDF.
     */
    (function() {
      const url = $(canvas).data("file");
      pdfjsLib.getDocument(url).then(function(pdfDoc_) {
        pdfDoc = pdfDoc_;
        $("#page-count").text(pdfDoc.numPages);
  
        // Initial/first page rendering
        renderPage(pageNum);
      });
    })();
  });
</script>