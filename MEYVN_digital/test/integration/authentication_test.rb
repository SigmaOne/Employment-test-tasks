require 'test_helper'

class AuthenticationTest < ActionDispatch::IntegrationTest
  def setup
    @user = users(:user_1)
  end

  test 'sign up followed by login followed by logout' do
    # TODO: add :\
  end

  test 'login followed by logout' do
    log_in @user
  end
end
