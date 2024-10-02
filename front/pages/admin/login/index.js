import React from 'react';
import 'bootstrap/dist/css/bootstrap.min.css';

function Login() {
    const currentYear = new Date().getFullYear(); // Get the current year

  return (
    <div className="d-flex flex-column min-vh-100">
      {/* Header */}
      <header className="bg-light shadow">
        <div className="container text-center py-3">
          <h1 className="h2">Fujtech Admin Panel</h1>
        </div>
      </header>

      {/* Main Content */}
      <main className="flex-grow-1 d-flex align-items-center justify-content-center">
        <div className="card shadow" style={{ width: '24rem' }}>
          <div className="card-body">
            <h2 className="card-title text-center mb-4">Login</h2>
            <form>
              <div className="mb-3">
                <label htmlFor="email" className="form-label">EMAIL OR USERNAME</label>
                <input
                  type="text"
                  id="email"
                  placeholder="Enter your email address"
                  className="form-control"
                />
              </div>
              <div className="mb-3">
                <label htmlFor="password" className="form-label">PASSWORD</label>
                <input
                  type="password"
                  id="password"
                  placeholder="********"
                  className="form-control"
                />
              </div>
              <div className="form-check mb-3">
                <input
                  type="checkbox"
                  className="form-check-input"
                  id="rememberMe"
                />
                <label className="form-check-label" htmlFor="rememberMe">Remember Me</label>
              </div>
              <button type="submit" className="btn btn-primary w-100" style={{ height: '50px' }}>Login</button>
            </form>
          </div>
        </div>
      </main>

      {/* Footer */}
      <footer className="bg-light text-center py-3">
      <p className="mb-0 text-muted">© {currentYear} Fujtech. All rights reserved.</p>

      </footer>
    </div>
  );
}

export default Login;