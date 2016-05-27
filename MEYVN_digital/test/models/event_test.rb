require 'test_helper'

class EventTest < ActiveSupport::TestCase
  def setup
    @event = events(:HNY)
  end

  test 'name, start_date, city should not be preset' do
    assert @event.valid?

    @event.name = ''
    assert_not @event.valid?
    @event.name = 'HNY'
    assert @event.valid?

    @event.city = nil
    assert_not @event.valid?
    @event.city = cities(:krasnodar)
    assert @event.valid?

    @event.start_date = nil
    assert_not @event.valid?
    @event.start_date = Date.new
    assert @event.valid?

    assert @event.valid?
  end
end
