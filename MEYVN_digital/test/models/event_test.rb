require 'test_helper'

class EventTest < ActiveSupport::TestCase
  def setup
    @event = events(:HNY)
    @city = City.new(name: 'krasnodar')
  end

  test 'name, start_date, city should not be preset' do
    assert @event.valid?

    @event.name = ''
    assert_not @event.valid?
    @event.name = 'HNY'

    @event.city = ''
    assert_not @event.valid?

    @event.start_date = nil
    assert_not @event.valid?
  end
end
