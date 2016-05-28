require 'test_helper'

class UserTest < ActiveSupport::TestCase
  test 'name should be present' do
    user = User.new(name: '')
    assert_not user.valid?

    user.name = 'Mike'
    assert user.valid?
  end
end
