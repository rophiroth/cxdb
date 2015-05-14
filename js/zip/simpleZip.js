var zipWriter;

function addFiles(files) {
    writer = new zip.BlobWriter();
    zip.createWriter(writer, function(writer) {
        zipWriter = writer;
        for (var f = 0; f < files.length; f++) {
            zipWriter.add(files[f].name,
            new zip.BlobReader(files[f]), function() {});
        }
    });
}

function saveZip() {
    zipWriter.close(function(blob) {
        saveAs(blob, "Example.zip"); // uses FileSaver.js
        document.getElementById("file-input").value = null; // reset input file list
        zipWriter = null;
    });
}