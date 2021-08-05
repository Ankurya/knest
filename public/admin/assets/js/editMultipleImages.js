
      max_images_check = $(".img_count").find('img').length - 1;
        if(max_images_check >= 10){
          $(".images_placehold").hide();
        }
        else{
          $(".images_placehold").show();
        }


        $(document).on("click",".remove-img",function(){
          $(".images_placehold").show();
        });

    

    $(document).on("click",".images_placehold",function(){

      max_images_check = $(".img_count").find('img').length - 1;
      //maximum_images_allowed = 10 - max_images_check;
      //alert(maximum_images_allowed)

        var file_Types = {"image" : ["jpeg","jpg","png"]};

          let util = {
            maxImages : 10,
           // maxImagesLen : 2097152, // 4194304 /*4MB*/
            maxImagesLen :  10485760, /*4MB*/
            totalMedia : 10,
            maxImageLenText : ((10485760 / 1024) / 1024) + "MB"
          }

      $("#image_error").text("").hide();
      let recursion = $(this).attr("data-recursion");
      recursion++;
      $(this).attr("data-recursion",recursion)

      $(".media_inputs .upload_images").append(`<input type="file" name="images[${recursion}][]" class="upload_image" multiple accept="image/*" />`)

      $(this).parent().find("input[name='images["+recursion+"][]']").click();

      $(document).on("change","input[name='images["+recursion+"][]']",function(event){
      var _this = $(this);
      let _cls = $(this).attr("name");
      _cls = _cls.replace("images",'');
      _cls = _cls.replace("[",'');
      _cls = _cls.replace("]",'');
      _cls = _cls.replace("[]",'');
      let files = event.target.files;
      var has_img_error = 0;
      var has_error = 0;
      var valid_images = 0;
      var image_len_error = 0;
      var zero_len = 0;
      var new_total_img = 0;

      let valid_file = files.length;
      for(let i = 0; i < files.length;i++){
        let spl = files[i].name.split(".");

        let file_len = files[i].size;

        if(file_len == 0){
          zero_len++;
        }

          let get_type = spl[spl.length-1];
          get_type = get_type.toLowerCase();
          if(file_Types.image.indexOf(get_type) == -1){
            has_error++;
          }

              if(file_Types.image.indexOf(get_type) != -1){
                  if(file_len > util.maxImagesLen){
                    image_len_error++;
                  }


                  let u_images = $(".ext_media_record").attr("total-media");

                  if(!localStorage.getItem("o_img")){
                    localStorage.setItem("o_img",u_images);
                  }

                  u_images = parseInt(u_images)
                  u_images = u_images + 1
                  valid_images++;
                  new_total_img++;

                  $(".ext_media_record").attr("total-media",u_images)
                }
            }

            let o_img = localStorage.getItem("o_img");

            if(o_img){
              localStorage.removeItem("o_img")
            }

            if(has_error > 0){
              if(o_img){
                o_img = parseInt(o_img);
                let uploaded_images_up = $(".ext_media_record").attr("total-media");
                uploaded_images_up = parseInt(uploaded_images_up)
                console.log("new ",uploaded_images_up,"old",o_img)
                if(uploaded_images_up >= o_img){ 

                  uploaded_images_up = uploaded_images_up - new_total_img;
                  $(".ext_media_record").attr("total-media",uploaded_images_up)
                }
              }
              

              _this.val("")
              $("#image_error").text(`Please upload ${file_Types.image.join(", ")} file only`).show();
              return false;
            }


            /* image check */
            let upload_img = parseInt($(".ext_media_record").attr("total-media"));

            //console.log(upload_img)
            if(upload_img > util.totalMedia){
              _this.val("")
              let uploaded_images = $(".ext_media_record").attr("total-media");
                uploaded_images = parseInt(uploaded_images) - valid_file;
              $(".ext_media_record").attr("total-media",uploaded_images)
                $("#image_error").text(`Maximum ${util.totalMedia} images are allowed`).show();
              return false;
            }
            //alert(uploaded_images);

            if(zero_len > 0){
              _this.val("")
                let uploaded_images = $(".ext_media_record").attr("total-media");
                uploaded_images = parseInt(uploaded_images) - valid_file;
              $(".ext_media_record").attr("total-media",uploaded_images)

                $("#image_error").text("File size should be greater than zero").show();
              return false;
            }
            

            if(image_len_error > 0){
               _this.val("")
              let image_error = $(".ext_media_record").attr("total-media");
                image_error = parseInt(image_error) - valid_file;
              $(".ext_media_record").attr("total-media",image_error)
              
              $("#image_error").text("Image size should not be greater than "+util.maxImageLenText+".").show();
              return false;
            }

              for(let i = 0; i < files.length;i++){
                let spl = files[i].name.split(".");
                let get_type = spl[spl.length-1];
                get_type = get_type.toLowerCase();

              let file_name = files[i].name;
                let trim_name = file_name.substr(0,((file_name.length-1) - get_type.length)).substr(0,30)+"."+get_type;

                if(file_Types.image.indexOf(get_type) != -1){

            var reader = new FileReader();
              reader.onload = function(e){
              $(".media_preview").prepend(`<div class="upload_images text-center">
              <i class="remove-img" data-parent = "${_cls+"_"+i}" title="Remove image" type="total-media"></i> 
              <img src="${e.target.result}" class="preview_image" title="${file_name}">
              <div class="slide_name" style='display:none' >${trim_name}</div>
              </div>`);
                }

              reader.readAsDataURL(files[i]);
          }else if(file_Types.video.indexOf(get_type) != -1){
            $(".media_preview").prepend(`<div class="upload_images col-5 text-center">
              <i class="remove-img" data-parent = "${_cls+"_"+i}" title="Remove video" type="total-media"></i> 
              <video controls loop src="${URL.createObjectURL(files[i])}" class="preview_image" title="${file_name}"></video>
              <div class="slide_name" style='display:none' media-name >${trim_name}</div>
              </div>`);
          }
         }

        if(parseInt($(".ext_media_record").attr("total-media")) >= util.totalMedia){
          $(".images_placehold").hide();
        }
      });
    });

    //not_accept
    $(document).on("click",".remove-img",function(){
      $("#image_error").text("").hide();
      let num = $(this).attr("data-parent");
      let index = num[0]
      let index1 = num[2]

      $(".non_acceptable_files").val($(".non_acceptable_files").val()+","+num)
      $(".ext_media_record").attr("total-media",parseInt($(".ext_media_record").attr("total-media")) - 1)

      $(this).parent().remove()
      setTimeout(function(){
        /*if($(".images_container").find(".upload_images").length < util.totalMedia){
          $(".images_placehold").show();
        }*/
        if(max_images_check < 10){
          $(".images_placehold").show();
        }
        
      },100)
    })


    $('.remove-img').click(function(){
      var close = $(this).attr('id');
      //var imgId = 'm'+close;
      //$("."+imgId).remove();
      $("."+close).remove();

      var deleted_images = $("#delete_image").val();
      if(deleted_images==""){
        $("#delete_image").val(close)
      }
      else{
          deleted_images = deleted_images+','+close;
          $("#delete_image").val(deleted_images)
      }

      //alert(close);
    })