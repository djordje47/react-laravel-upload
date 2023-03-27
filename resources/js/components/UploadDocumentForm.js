import React, {useState} from "react";
import Swal from "sweetalert2";

function UploadDocumentForm({setUploads}) {
  const [description, setDescription] = useState();
  const [file, setFile] = useState();
  const [emails, setEmails] = useState(undefined);
  const handleSubmit = (e) => {
    e.preventDefault();
    const formData = new FormData();
    formData.append("file", file);
    formData.append("description", description);
    formData.append("emails", emails);
    if (emails === undefined) {
      formData.append("emails", null);
    }
    axios
    .post("/upload-file", formData, {
      headers: {
        "Content-Type": "multipart/form-data",
      },
    })
    .then(({data}) => {
      const {upload, message} = data;
      if (upload) {
        setUploads((prevState) => [...prevState, upload]);
        Swal.fire({
          title: "<h3>Success!</h3>",
          icon: "success",
          text: message,
        });
      } else {
        Swal.fire({
          title: "<h3>Error!</h3>",
          icon: "error",
          text: message,
        });
      }
    })
    .catch((err) => {
      console.log(err);
    });
  };
  return (
      <form onSubmit={(e) => handleSubmit(e)}>
        <div className="row d-flex justify-content-center align-items-center">
          <div className="col-12">
            <label htmlFor="file">File</label>
            <input
                className="form-control"
                type="file"
                onChange={(e) => setFile(e.target.files[0])}
                name="file"
            />
          </div>
          <div className="col-12">
            <label htmlFor="description">Description</label>
            <textarea
                className="form-control"
                name="description"
                value={description}
                onChange={(e) => setDescription(e.target.value)}
            ></textarea>
          </div>
          <div className="col-12">
            <label htmlFor="description">Emails</label>
            <textarea
                className="form-control"
                name="description"
                value={emails}
                onChange={(e) => setEmails(e.target.value)}
            ></textarea>
          </div>
          <div className="col-6 text-center my-2">
            <button className="btn btn-outline-primary">Upload</button>
          </div>
        </div>
      </form>
  );
}

export default UploadDocumentForm;
