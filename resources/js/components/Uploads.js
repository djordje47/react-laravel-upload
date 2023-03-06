import React from "react";
import moment from "moment";

function Uploads({ uploads }) {
    return (
        <div>
            <div className="list-group">
                {uploads.length ? (
                    uploads.map((upload) => (
                        <div key={upload.id} className="list-group-item">
                            <div className="row">
                                <div className="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <a href={upload.path} target="_blank">
                                        {upload.name}
                                    </a>
                                    <p className="mb-0">{upload.description}</p>
                                </div>
                                <div className="col-lg-6 col-md-6 col-sm-12 col-xs-12 text-lg-end">
                                    <span className="badge bg-primary">
                                        {moment(upload.created_at).format(
                                            "DD-MM-YYYY, h:mm:ss a"
                                        )}
                                    </span>
                                </div>
                            </div>
                        </div>
                    ))
                ) : (
                    <div className="alert alert-info">
                        <p>There are no uploaded files.</p>
                    </div>
                )}
            </div>
        </div>
    );
}

export default Uploads;
