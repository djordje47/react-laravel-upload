import React from 'react';

const Header = () => {
  return (
      <header>
        <ul className="nav justify-content-start">
          <li className="nav-item me-auto">
            <a className="nav-link active" aria-current="page" href="https://djolecodes.com">djole's file uploader</a>
          </li>
          <li className="nav-item">
            <a className="nav-link" href="#">Home</a>
          </li>
        </ul>
      </header>
  )
};

export default Header;