import React, {Fragment} from 'react';
import ReactDOM from 'react-dom';
import Header from "./layout/header";
import Footer from "./layout/footer";

function App() {
  const handleSubmit = (e) => {
    e.preventDefault();
    console.log(e.target)
    const formData = new FormData(e.target);
    console.log(formData)
    console.log(formData.get('file'))
  }
  return (
      <>
        <Header/>
        <div className="row gx-0 form-row">
          <div className="col-md-8">
            <div className="card">
              <div className="card-header">Form to upload files</div>
              <div className="card-body">
                <form onSubmit={e => handleSubmit(e)}>
                  <div className="row">
                    <div className="col-8">
                      <label htmlFor='file'>File</label>
                      <input className='form-control' type="file" name='file'/>
                    </div>
                    <div className="col-2 flex-column justify-content-end align-content-center">
                      <button className='btn btn-block btn-primary'>Upload</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <Footer/>
      </>
  );
}

export default App;

if (document.getElementById('app')) {
  ReactDOM.render(<App/>, document.getElementById('app'));
}
