<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('/')}}css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('/')}}css/all.min.css">
    <link rel="stylesheet" href="{{asset('/')}}css/style.css">
    <title></title>
</head>

<body>

    <!--start bill-->

    <section class="my-bill canvas_div_pdf">
        <div class="container">
            <div class="bill-details">
                <div class="right-details">
                    <span class="tit">من</span>
                    <h3>  @if ($invoice->company)
                        {{$invoice->company->name}}
                    @else
                        إسم الشركة
                    @endif
                </h3>
                    <p><span class="right-info">البريد الالكتروني:</span>
                        @if ($invoice->company)
                        {{$invoice->company->email}}
                        @else
                         xxxxx@company.com
                        @endif
                    </p>
                    <p><span class="right-info">العنوان: </span>
                        @if ($invoice->company)
                        {{$invoice->company->address}}
                        @else
                         الرياض - الممكلة العربية السعودية
                        @endif
                    </p>
                    <p><span class="right-info">رقم السجل الضريبي:
                        @if ($invoice->company)
                        {{$invoice->company->vat}}
                        @else
                         xxxxx-xxxx-xx
                        @endif
                    </span>مصر</p>
                    <p><span class="right-info">الهاتف: </span>
                        @if ($invoice->company)
                        Phone Number: {{$invoice->company->phone}}
                        @else
                        05########
                        @endif
                    </p>
                </div>
                <div class="mid-details">
                    <img height="100" width="100"
                    @if ($invoice->company)
                    src="{{$invoice->company->logo_link}}"
                    @else
                    src="{{asset('placeholder.png')}}"
                    @endif
                    >
                    <br>
                    <br>
                    <img height="100" width="100" style="border-radius: 0"
                    @if ($invoice->company)
                    src="{{$invoice->qr_link}}"
                    @else
                    src="{{asset('placeholder.png')}}"
                    @endif
                    >
                </div>
                <div class="left-details">
                    <span class="tit">الى</span>
                    <h3>{{$invoice->customer->name}}</h3>
                    <p><span class="right-info">البريد الالكتروني:</span>{{$invoice->customer->email}}</p>
                    <p><span class="right-info">العنوان: </span>{{$invoice->customer->address}}</p>
                    <p><span class="right-info">الدولة: </span>{{$invoice->customer->country}}</p>
                    <p><span class="right-info">الهاتف: </span>{{$invoice->customer->phone}}</p>
                </div>
            </div>
            <div class="bill">
                <p><span>رقم الفاتورة : </span> @if($invoice->number != null){{$invoice->number}}@else {{$invoice->id}} @endif</p>
                <p><span>التاريخ : </span>{{ $invoice->date }}</p>
            </div>
            <div class="bill-info">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">الاسم</th>
                            <th scope="col">التكلفة</th>
                            <th scope="col">الكمية</th>
                            <th scope="col">الاجمالي</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($invoice->items as $item)

                        <tr>
                            <td>{{$item->id}}</td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->price}} </td>
                            <td>{{$item->qty}}</td>
                            <td>{{$item->total}} </td>
                        </tr>
                        @empty

                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="bottom-det">
                <div class="all-flex">
                    <h4>المجموع الفرعي</h4>
                    <span>{{$invoice->sub_total}}</span>
                </div>
                <div class="all-flex">
                    <h4>الضريبة</h4>
                    <span>{{$invoice->tax}} %</span>
                </div>
                <div class="all-flex">
                    <h4>قيمة الضريبة</h4>
                    <span>{{$invoice->tax_amount}}</span>
                </div>

                <div class="all-flex">
                    <h4>الاجمالي</h4>
                    <span>{{$invoice->total_amount}}</span>
                </div>
            </div>
        </div>
    </section>

    <a href="#" class="download">
        <div class="before">
            <span> pdf تحميل نسخة </span>
            <i class="fas fa-download"></i>
        </div>
        <div class="after hide">
            <span> جاري التحميل الأن </span>
            <i class="fas fa-spinner"></i>
        </div>
    </a>

    <!--end bill-->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/printThis.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.3/jspdf.min.js"></script>
    <script src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>
    <script src="js/main.js"></script>
<script>
jQuery(function ($) {
    $(".download").click(function() {
        $(".download .before").addClass("hide");
        $(".download .after").removeClass("hide");
        getPDF();
    });

    function getPDF() {
        setTimeout(function() {
            var HTML_Width = $(".canvas_div_pdf").width();
            var HTML_Height = $(".canvas_div_pdf").height();
            var top_left_margin = 0;
            // var PDF_Width = HTML_Width + (top_left_margin * 2);
            // var PDF_Height = (PDF_Width * 4.5) + (top_left_margin * 2);
            var PDF_Width = HTML_Width + (top_left_margin * 2);
            var PDF_Height = (PDF_Width * 4.5) + (top_left_margin * 2);
            var canvas_image_width = HTML_Width;
            var canvas_image_height = HTML_Height;
            var totalPDFPages = Math.ceil(HTML_Height / PDF_Height) - 1;
            html2canvas($(".canvas_div_pdf")[0], {
                allowTaint: true
            }).then(function(canvas) {
                canvas.getContext('2d');
                var imgData = canvas.toDataURL("image/jpeg", 1.0);
                var pdf = new jsPDF('l', 'mm', [297, 210]);
                var width = 297;
                var height= 210;
                pdf.addImage(imgData, 'JPG', top_left_margin, top_left_margin, width, height);
                for (var i = 1; i <= totalPDFPages; i++) {
                    pdf.addPage(PDF_Width, PDF_Height);
                    pdf.addImage(imgData, 'JPG', top_left_margin, -(PDF_Height * i) + (top_left_margin * 4), canvas_image_width, canvas_image_height);
                }
                $(".download .before").removeClass("hide");
                $(".download .after").addClass("hide");
                pdf.save("bill.pdf");
            });
        }, 1000);
    }
});
</script>

</body>

</html>
