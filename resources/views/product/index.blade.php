@extends('layouts.admin')
@push('css_script')
<link
  rel="stylesheet"
  href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/css/selectize.default.min.css"
  integrity="sha512-pTaEn+6gF1IeWv3W1+7X7eM60TFu/agjgoHmYhAfLEU8Phuf6JKiiE8YmsNC0aCgQv4192s4Vai8YZ6VNM6vyQ=="
  crossorigin="anonymous"
  referrerpolicy="no-referrer"
/>

@endpush
@push('css_script')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">

@endpush
@push('css_script')
<style>
    .upload__box p {
        margin: 0;
        padding: 15px 0px;
      }
    .upload__box {
        padding: 40px;
      }
      .upload__inputfile {
        width: 0.1px;
        height: 0.1px;
        opacity: 0;
        overflow: hidden;
        position: absolute;
        z-index: -1;
      }
      .upload__btn {
        display: inline-block;
        width: 100% !important;

        font-weight: 600;
        color: #fff;
        text-align: center;
        min-width: 116px;

        transition: all 0.3s ease;
        cursor: pointer;
        border: 2px solid;
        background-color: #4045ba;
        border-color: #4045ba;
        border-radius: 10px;

        font-size: 14px;
      }
      .upload__btn:hover {
        background-color: unset;
        color: #4045ba;
        transition: all 0.3s ease;
      }
      .upload__btn-box {
        margin-bottom: 10px;
      }
      .upload__img-wrap {
        display: flex;
        flex-wrap: wrap;
        margin: 0 -10px;
      }
      .upload__img-box {
        width: 100px;
        padding: 0 10px;
        margin-bottom: 12px;
      }
      .upload__img-close {
        width: 24px;
        height: 24px;
        border-radius: 50%;
        background-color: rgba(0, 0, 0, 0.5);
        position: absolute;
        top: 10px;
        right: 10px;
        text-align: center;
        line-height: 24px;
        z-index: 1;
        cursor: pointer;
      }
      .upload__img-close:after {
        content: "✖";
        font-size: 14px;
        color: white;
      }

      .img-bg {
        background-repeat: no-repeat;
        background-position: center;
        background-size: cover;
        position: relative;
        padding-bottom: 100%;
      }
</style>

@endpush
@section('dashboard')
<div class="col-lg-12">
    <div class="card">
        <div class="card-header">Product List</div>
        <div class="card-body">
            <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label for="category">Category</label>
                            <select name="category" id="category" class="form-control" id="category">
                                <option value="">select category</option>
                                @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->category_name }}</option>

                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label for="subcategory">SubCategory</label>
                            <select name="subcategory" id="subcategory" class="form-control">
                                <option value="">select subcategory</option>
                                @foreach ($subcategories as $subcategory)
                                <option value="{{ $subcategory->id }}">{{ $subcategory->subcategory_name }}</option>

                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label for="brand">Brands</label>
                            <select name="brand" id="brand" class="form-control">
                                <option value="">select brand</option>
                                @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}">{{ $brand->brand_name }}</option>

                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="price">Product Price:</label>
                            <input type="number" name="price" id="product_price" class="form-control">

                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="product">Product Name:</label>
                            <input type="text" name="product_name" id="product_name" class="form-control">

                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="discount">Product Discount:</label>
                            <input type="number" name="discount" id="product_count" class="form-control">

                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="tags">Product Tags:</label>
                            <input type="text" name="tags[]"  id="input-tags" class="form-control">

                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label for="price">Short Description:</label>
                           <textarea name="short_desp" class="form-control" id="short_desp" cols="30" rows="10" ></textarea>

                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label for="price">Long Description:</label>
                           <textarea name="long_desp" id="summernote" cols="30" rows="10" ></textarea>

                        </div>
                    </div>
                     <div class="col-lg-12">
                        <div class="mb-3">
                            <label for="price">Addition Info:</label>
                           <textarea name="addi_info" id="add" cols="30" rows="10" ></textarea>

                        </div>
                    </div>
                    <div class="col-lg-6">
                        <label for="preview">Preview</label>
                        <input type="file" name="preview" id="preview" class="form-control">
                    </div>
                    <div class="col-lg-6">
                        <div class="upload__box">
                            <div class="upload__btn-box">
                              <label class="upload__btn">
                                <p>Upload images</p>
                                <input type="file" multiple="" name="gallery[]" data-max_length="20" class="upload__inputfile">
                              </label>
                            </div>
                            <div class="upload__img-wrap"></div>
                          </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>






                </div>

            </form>
        </div>
    </div>
</div>

@endsection
@push('js_script')

<script
  src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/js/selectize.min.js"
  integrity="sha512-IOebNkvA/HZjMM7MxL0NYeLYEalloZ8ckak+NDtOViP7oiYzG5vn6WVXyrJDiJPhl4yRdmNAG49iuLmhkUdVsQ=="
  crossorigin="anonymous"
  referrerpolicy="no-referrer"
></script>
<script>
    $('#category').change(function(){
        var category_id=$(this).val()
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type:'POST',
            url:'getsubcategory',
            data:{'category_id':category_id},
            success:function(data){
                $('#subcategory').html(data)
            },
        })

    })

</script>
<script>
    $("#input-tags").selectize({
        delimiter: ",",
        persist: false,
        create: function (input) {
          return {
              value: input,
              text: input,
          };
        },
      });
</script>


@endpush
@push('js_script')




<!-- include summernote css/js -->

<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script>
    $(document).ready(function() {
        $('#summernote').summernote();
      });
</script>
<script>
    $(document).ready(function() {
        $('#add').summernote();
      });
</script>
<script>
    $(document).ready(function() {
        $('#short_desp').summernote();
      });
</script>
<script>
    jQuery(document).ready(function () {
        ImgUpload();
      });

      function ImgUpload() {
        var imgWrap = "";
        var imgArray = [];

        $('.upload__inputfile').each(function () {
          $(this).on('change', function (e) {
            imgWrap = $(this).closest('.upload__box').find('.upload__img-wrap');
            var maxLength = $(this).attr('data-max_length');

            var files = e.target.files;
            var filesArr = Array.prototype.slice.call(files);
            var iterator = 0;
            filesArr.forEach(function (f, index) {

              if (!f.type.match('image.*')) {
                return;
              }

              if (imgArray.length > maxLength) {
                return false
              } else {
                var len = 0;
                for (var i = 0; i < imgArray.length; i++) {
                  if (imgArray[i] !== undefined) {
                    len++;
                  }
                }
                if (len > maxLength) {
                  return false;
                } else {
                  imgArray.push(f);

                  var reader = new FileReader();
                  reader.onload = function (e) {
                    var html = "<div class='upload__img-box'><div style='background-image: url(" + e.target.result + ")' data-number='" + $(".upload__img-close").length + "' data-file='" + f.name + "' class='img-bg'><div class='upload__img-close'></div></div></div>";
                    imgWrap.append(html);
                    iterator++;
                  }
                  reader.readAsDataURL(f);
                }
              }
            });
          });
        });

        $('body').on('click', ".upload__img-close", function (e) {
          var file = $(this).parent().data("file");
          for (var i = 0; i < imgArray.length; i++) {
            if (imgArray[i].name === file) {
              imgArray.splice(i, 1);
              break;
            }
          }
          $(this).parent().parent().remove();
        });
      }
</script>

@endpush

