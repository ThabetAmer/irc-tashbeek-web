import {$httpRequester} from './httpRequester';
import queryString from '../helpers/QueryString'

export const get = (type, params = {}) => {
  return $httpRequester.get(`api/cases/${type}?${queryString.serialize(params)}`)
}


export const getByUrl = (url, params = {}) => {
  return $httpRequester.get(`${url}?${queryString.serialize(params)}`)
}