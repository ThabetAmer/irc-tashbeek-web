import {$httpRequester} from './httpRequester';

export const upcomingFollowups = (date,params = {}) => {
  return $httpRequester.get(`api/upcoming-followups?followup_date=${date}`)
}


export const upcomingFollowupsCount = (date,params = {}) => {
  return $httpRequester.get(`api/upcoming-followups/counts?followup_date=${date}`)
}

