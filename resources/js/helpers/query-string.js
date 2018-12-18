import queryString from 'qs'

export const queryStringToParams = (key = null) => {
  const params = queryString.parse(location.search.substring(1));
  return key ? params[key] : params
}