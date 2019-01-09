import {$httpRequester} from './httpRequester';
import queryString from '../helpers/QueryString'

export const get = (params = {}) => {
  return $httpRequester.get(`api/users?${queryString.serialize(params)}`)
}


export const activateUser = (id,params = {}) => {
  return $httpRequester.post(`api/user/${id}/activate`)
}

export const deactivateUser = (id,params = {}) => {
  return $httpRequester.post(`api/user/${id}/deactivate`)
}