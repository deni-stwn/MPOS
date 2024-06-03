<script>
    function filterMedia(media, collectionName) {
        return media.filter(function(mediaItem) {
            return mediaItem.collection_name === collectionName;
        });
    }

    function hapusLocalhost(url) {
        let index = url.indexOf('/storage');
        return index !== -1 ? url.substring(index) : url;
    }

    function displayExistingFiles(dropzone, filterimages) {
        filterimages.forEach(function(filterimage) {
            let path = hapusLocalhost(filterimage.original_url);
            if (typeof path === 'string') {
                dropzone.displayExistingFile({
                    name: filterimage.file_name,
                    size: filterimage.size,
                    type: filterimage.mime_type,
                    status: Dropzone.SUCCESS,
                    url: path,
                }, path);
            } else {
                console.error('Invalid file URL:', path);
            }
        });
    }

    function removeFile(dropzone) {
        dropzone.on("removedfile", function(file) {
            $.ajax({
                url: "{{ route('media.remove') }}",
                type: "POST",
                data: {
                    fileName: file.name,
                    _token: "{{ csrf_token() }}",
                },
                success: function(response) {
                    console.log(
                        "File has been removed from server"
                    );
                },
                error: function(response) {
                    console.error(
                        "Error while removing file from server"
                    );
                }
            });
        });
    }

    window.setEditDropzone = function(element, data, collectionName) {
        $(element).empty();
        let myDropzone = Dropzone.forElement(element);
        myDropzone.removeAllFiles();
        let filterimages = filterMedia(data.media, collectionName);
        if (filterimages.length > 0) {
            displayExistingFiles(myDropzone, filterimages);
        } else {
            $(element).append('<div class="dz-message">Drop files here or click to upload.</div>');
        }
        removeFile(myDropzone);
    }

    window.formatDate = function(dateString) {
        var date = new Date(dateString);
        var day = date.getDate();
        var month = date.toLocaleString('default', {
            month: 'long'
        });
        var year = date.getFullYear();
        let hours = date.getHours();
        let minutes = date.getMinutes();
        let seconds = date.getSeconds();

        return `${day} ${month} ${year} ${hours}:${minutes}:${seconds}`;
    }
</script>
