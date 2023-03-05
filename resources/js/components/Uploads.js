import React from "react";
import moment from "moment";

function Uploads({uploads}) {
  return (
      <div>
        <ul className="list-group">
          {uploads.length ? (
              uploads.map((upload) => (
                  <li key={upload.id} className="list-group-item">
                    <div className="row">
                      <div className="col-6">
                        <a href={upload.path} target="_blank">
                          {upload.name}
                        </a>
                        <p className="mb-0">{upload.description}</p>
                      </div>
                      <div className="col-6 text-end">
                                    <span className="badge bg-primary">
                                        {moment(upload.created_at).format(
                                            "DD-MM-YYYY, h:mm:ss a"
                                        )}
                                    </span>
                      </div>
                    </div>
                  </li>
              ))
          ) : (
              <div className="alert alert-info">
                <p>There are no uploaded files.</p>
              </div>
          )}
        </ul>
      </div>
  );
}

export default Uploads;
