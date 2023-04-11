function requireBasicAuth(req, res, next) {
  const authHeader = req.headers.authorization;
  if (!authHeader || !authHeader.startsWith('Basic ')) {
    res.status(401).setHeader('WWW-Authenticate', 'Basic realm="Restricted Area"').end('Unauthorized');
    return;
  }

  const base64Credentials = authHeader.slice('Basic '.length);
  const credentials = Buffer.from(base64Credentials, 'base64').toString('ascii');
  const [username, password] = credentials.split(':');

  if (username === process.env.BASIC_AUTH_USER && password === process.env.BASIC_AUTH_PASSWORD) {
    next();
  } else {
    res.status(401).setHeader('WWW-Authenticate', 'Basic realm="Restricted Area"').end('Unauthorized');
  }
}

module.exports = requireBasicAuth;
