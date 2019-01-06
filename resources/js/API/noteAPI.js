import {$httpRequester} from './httpRequester';

export const get = (seekerId, params = {}) => {
  return $httpRequester.get(`api/case-notes/job-seeker/${seekerId}/`)
}


export const post = (seekerId, params = {}) => {
  console.log(' params are ', params)
  return $httpRequester.post(`api/case-notes/job-seeker/${seekerId}/`,params)
}

