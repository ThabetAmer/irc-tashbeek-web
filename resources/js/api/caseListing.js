import {$httpRequester} from './httpRequester';
import queryString from '../helpers/QueryString'

export const get = (type, params = {}) => {
  return $httpRequester.get(`api/cases/${type}?${queryString.serialize(params)}`)
}