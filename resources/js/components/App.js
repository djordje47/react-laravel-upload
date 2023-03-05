import React, {useEffect, useState} from "react";
import ReactDOM from "react-dom";
import UploadDocumentForm from "./UploadDocumentForm";
import Uploads from "./Uploads";

function App() {
  const [uploads, setUploads] = useState([]);
  useEffect(() => {
    axios
    .get("/get-uploads")
    .then(({data}) => {
      setUploads((prevState) => {
        return data.uploads;
      });
    })
    .catch((err) => {
      console.log(err);
    });
  }, []);
  return (
      <div className="container">
        <div className="row justify-content-center">
          <div className="col-10">
            <div className="card my-2">
              <div className="card-header">Previous uploads</div>
              <div className="card-body">
                <Uploads uploads={uploads}/>
              </div>
            </div>
            <div className="card">
              <div className="card-header">Form to upload files</div>
              <div className="card-body">
                <UploadDocumentForm setUploads={setUploads}/>
              </div>
            </div>
          </div>
        </div>
      </div>
  );
}

export default App;

if (document.getElementById("app")) {
  ReactDOM.render(<App/>, document.getElementById("app"));
}
