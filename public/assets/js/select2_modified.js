 $.fn.select2_modified = function (options) {
   $(this).select2({

      ajax: {
        url:options.url,
        dataType: 'json',
        delay: 250,
        type:"POST",
        data: function (params) {

            return {
                q: params.term,
                _token: options.token,
                field: options.field,
                id:options.id,
                name:options.name,
                clausefield: options.clause?options.clause.fields:"",
                clausevalue: options.clause?options.clause.values:"",
                clause:options.clause, // search term
            };
        },
        processResults: function (data) {
          console.log(data);

            return {
                results: data
            };
        },
        cache: true
        },
        
        afterSelect :function (data){

          if(data.id !== ''){
            $('.nextBtn').focus();
          }
        },
        placeholder: options.label,
        minimumInputLength: 0,
      });

      if(typeof options.value !=='undefined'){
        console.log(options)
         var newOption = new Option(options.value.text,options.value.id , true, true);
         $(this).append(newOption).trigger('change');
      }
}





