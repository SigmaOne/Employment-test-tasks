require 'test_helper'

class EventTest < ActiveSupport::TestCase
  def setup
    @event = events(:HNY)
    @city = City.new(name: 'krasnodar')
  end

  test 'name, start_date, city, address should not be nil' do
    puts @event.inspect
  end
end
