</div>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script type="text/javascript">
$("#file").bind("drop", function(e) {
	console.log("l");
    var files = e.originalEvent.dataTransfer.files;
    processFileUpload(files);
    // forward the file object to your ajax upload method
    return false;
});

function processFileUpload(droppedFiles) {
    // add your files to the regular upload form
    var uploadFormData = new FormData($("#file")[0]);
    if (droppedFiles.length > 0) { // checks if any files were dropped
        for (var f = 0; f < droppedFiles.length; f++) { // for-loop for each file dropped
            uploadFormData.append("files[]", droppedFiles[f]); // adding every file to the form so you could upload multiple files
        }
    }

    // the final ajax call

    $.ajax({
        url: "<?php echo base_url('image/upload'); ?>", // use your target
        type: "POST",
        data: uploadFormData,
        cache: false,
        contentType: false,
        processData: false,
        success: function(ret) {
            console.log("l");
        }
    });

}
</script>
</body>
</html>